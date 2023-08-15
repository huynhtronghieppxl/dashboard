<div class="modal fade" id="modal-update-addition-food-brand-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom" id="loading-modal-update-addition-food-brand-manage">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.food-brand-manage.update.tab3')</h4>
                <button type="button" class="close ml-4" onclick="closeModalAdditionUpdateFoodManage()" onkeypress="closeModalAdditionUpdateFoodManage()">
                    <i class="fi-rr-cross"></i>
                </button>

            </div>
            <div class="modal-body text-left" id='tab-info-update-addition-food-manager'>
                <div class="row">
                    <div class="col-lg-12 edit-flex-auto-fill pr-1">
                        <div class="card-block card flex-sub">
                            <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15" id="title-update-info-food-addition-brand-manage">
                                @lang('app.food-brand-manage.update.food-info')
                            </h6>
                            <div class="row pt-4">
                                <div class="col-lg-3 p-0 text-center">
                                    <div class="profile-thumb">
                                        <img class="profile-image-avatar" alt="" onerror="imageDefaultOnLoadError($(this))" src="{{asset('images/food_file.jpg', env('IS_DEPLOY_ON_SERVER'))}}"
                                             id="picture-update-addition-food-brand-manage" data-url-avt="" data-url-thumb style="border-radius: 50%;border: 3px solid #c1c1c1;width: 11rem;height: 11rem">
                                        <div class="edit-profile pointer" style="right: 45px">
                                            <label class="fileContainer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" id="input-picture-update-addition-food-brand-manage" accept="image/*">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 pt-1 px-0">
                                    <div class="row">
                                        <!--tên món-->
                                        <div class="form-group col-lg-6 m-0 validate-group">
                                            <div class="form-validate-input">
                                                <input id="name-update-addition-food-brand-manage" class="form-control" data-spec="1" data-emoji="1"
                                                       type="text"  data-spec="1" data-min-length="2" data-max-length="50" data-empty="1">
                                                <label for="name-update-addition-food-brand-manage">
                                                    @lang('app.food-brand-manage.update.name')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                        <!--mã món-->
                                        <div class="form-group col-lg-6 m-0 validate-group">
                                            <div class="form-validate-input">
                                                <input id="code-update-addition-food-brand-manage" data-spec="1" data-emoji="1" disabled class="form-control" data-min-length="2" data-max-length="50">
                                                <label for="code-update-addition-food-brand-manage">
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
                                                    <select data-icon="fa-book" class="js-example-basic-single select2-hidden-accessible" data-select="1"
                                                            id="unit-update-addition-food-brand-manage">
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
                                                    <select data-icon="fa-book" class="js-example-basic-single select2-hidden-accessible" data-select="1"
                                                            id="category-update-addition-food-brand-manage">
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.food-brand-manage.update.category')
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12 select2_theme validate-group">
                                            <!--sở thích món bán kèm-->
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select id="note-addition-update-food-brand-manage" class="js-example-basic-single col-sm-12 select2-hidden-accessible" multiple=""></select>
                                                    <label class="icon-validate">
                                                        @lang('app.food-brand-manage.update.note-food')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pt-1">
                                    <div class="row">
                                        <!-- time -->
                                        <div class="form-group w-100 validate-group">
                                            <!--thời gian món bán kèm-->
                                            <div class="form-validate-input">
                                                <input id="time-update-addition-food-brand-manage" data-max="120" class="form-control text-right">
                                                <label for="time-update-addition-food-brand-manage">
                                                    @lang('app.food-brand-manage.update.time')
                                                </label>
                                            </div>
                                        </div>
                                        <!-- ghi chú -->
                                        <div class="form-group validate-group w-100">
                                            <div class="form-validate-textarea">
                                                <div class="form__group pt-2">
                                                        <textarea id="description-update-addition-food-brand-manage" class="form__field"
                                                                  rows="3" cols="1" data-note-max-length="1000"></textarea>
                                                    <label for="description-update-addition-food-brand-manage"
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
                                <div class="w-100" id="tab-addition-food-brand-manage">
                                    <div class="row w-100">
                                        <!--cách bán-->
                                        <div class="form-group col-lg-3 m-0 mb-3 row class-food-create-food-manage class-combo-create-food-manage class-addition-create-food-manage">
                                            <div class=" col-lg-12 form-group checkbox-group pl-0" >
                                                <label class="title-checkbox">@lang('app.food-brand-manage.update.sell-by')</label>
                                                <div class="row" id="sell-by-update-addition-food-brand-manage">
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="sell" value="0"
                                                                   data-icon=" " checked>
                                                            <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">@lang('app.food-brand-manage.update.option-sell-by-lot')
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="sell" value="1">
                                                            <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">@lang('app.food-brand-manage.create.option-sell-by-weight')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12 validate-group pl-0">
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox"   id="is-like-addition-update-food-brand-manage" >
                                                        <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">
                                                            @lang('app.food-brand-manage.create.like-food')                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- hình thức bán -->
                                        <div class="form-group col-lg-3 d-none">
                                            <div class=" col-lg-12 form-group checkbox-group  pl-0">
                                                <label class="title-checkbox"> @lang('app.food-brand-manage.update.take-away')</label>
                                                <div class="row" id="take-away-addition-update-food-brand-manage">
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="take" value="0"  data-icon="icofont-ui-file" >
                                                            <label class="name-checkbox"  >@lang('app.food-brand-manage.update.option-no-take-away')
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="take" value="1"
                                                                   data-icon="icofont-ui-file" checked>
                                                            <label class="name-checkbox"  >@lang('app.food-brand-manage.update.option-take-away')
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="take" value="2"
                                                                   data-icon="icofont-ui-file">
                                                            <label class="name-checkbox"  >@lang('app.food-brand-manage.update.option-take-all')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--in bếp/kho bia-->
                                        <div class="form-group col-lg-3 validate-group">
                                            <div class="form-validate-checkbox" style="padding-top: 23px">
                                                <div class="checkbox-form-group">
                                                    <input type="checkbox" id="print-addition-update-food-brand-manage">
                                                    <label class="name-checkbox"
                                                           for="print-kitchen-create-food-brand-manage">
                                                        @lang('app.food-brand-manage.update.print')
                                                    </label>
                                                </div>
                                            </div>
                                            <!--stamp-->
                                            <div class="form-validate-checkbox print-stamp-update-food-brand-manage-div disabled">
                                                <div class="form-validate-checkbox" style="padding-top: 10px">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox"  id="print-stamp-update-food-brand-manage" disabled>
                                                        <label class="name-checkbox"
                                                               for="print-kitchen-create-food-brand-manage">
                                                            @lang('app.food-brand-manage.update.print-stamp')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bán lẻ -->
{{--                                        <div class="form-group col-lg-3 validate-group">--}}
{{--                                            <div class="form-validate-checkbox">--}}
{{--                                                <div class="checkbox-form-group">--}}
{{--                                                    <input type="checkbox"   id="is-like-addition-update-food-brand-manage" >--}}
{{--                                                    <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">--}}
{{--                                                        @lang('app.food-brand-manage.create.like-food')                                                    </label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15 w-100">
                                        @lang('app.food-brand-manage.update.food-price')
                                        <label class="text-lowercase text-warning">(*) Nhập giá chính xác sẽ cho báo cáo chính xác </label>
                                    </h6>
                                    <div class="row pt-4 w-100">
                                        <!--Giá Vốn-->
                                        <div class="form-group col-lg-3 m-0 validate-group">
                                            <div class="form-validate-input">
                                                <input id="original-update-addition-food-brand-manage" type="text"
                                                       class="form-control text-right" data-number="1"
                                                       data-max="999999999">
                                                <label for="original-update-addition-food-brand-manage">
                                                    @lang('app.food-brand-manage.update.original-price')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                        <!--giá bán-->
                                        <div class="form-group col-lg-3 m-0 validate-group">
                                            <div class="form-validate-input">
                                                <input type="text" class="form-control text-right"
                                                       id="price-update-addition-food-brand-manage" data-number="1"
                                                       data-max="999999999">
                                                <label for="price-update-addition-food-brand-manage">
                                                    @lang('app.food-brand-manage.update.price')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="d-flex align-items-center mt-1 float-right">
                                                @if( Session::get(SESSION_KEY_LEVEL) >= 8)
                                                    @lang('app.food-brand-manage.create.point'):
                                                    <div style="width: auto" class="seemt-orange ml-1" id="point-update-addition-food-brand-manage">0</div>
                                                @endif
                                            </div>

                                        </div>
                                        <!--lợi nhuận-->
                                        <div class="mb-0 form-group col-lg-3">
                                            <div class="form-validate-input">
                                                <input type="text" class="form-control text-right" disabled id="profit-update-addition-food-brand-manage">
                                                <label for="undefined">
                                                    @lang('app.food-brand-manage.update.profit')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                            <div class="d-flex align-items-center mt-1 float-right">
                                                @lang('app.food-brand-manage.create.profit_margin')
                                                @include('manage.food.brand.tooltip.profit_rate_by_price'):
                                                <div style="width: auto" class="seemt-orange ml-1" id="profit-margin-update-addition-food-brand-manage">   0%</div>
                                            </div>
                                        </div>
                                        <!-- VAT -->
                                        <div class="form-group col-lg-3 select2_theme validate-group" id="check-vat-update-food-brand-manage">
                                            <div class="form-validate-select ">
                                                <div class="col-lg-12 mx-0 px-0">
                                                    <div class="col-lg-12 pr-0 select-material-box">
                                                        <select id="vat-update-addition-food-brand-manage"
                                                                class="js-example-basic-single col-sm-12 select2-hidden-accessible"></select>
                                                        <label class="icon-validate">
                                                            @lang('app.food-brand-manage.update.vat')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(Session::get(SESSION_KEY_LEVEL) > 3)
                                        <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15 w-100">
                                            @lang('app.food-brand-manage.update.food-admin')
                                        </h6>
                                        <div class="row pt-4 w-100">
                                            <!-- review -->
                                            @if(Session::get(SESSION_KEY_LEVEL) >= 8)
                                            <div class="form-group col-lg-3 validate-group">
                                                <div class="form-validate-checkbox">
                                                    <div class="checkbox-form-group">
                                                        <input type="checkbox"    id="review-addition-update-food-brand-manage" >
                                                        <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">
                                                            @lang('app.food-brand-manage.update.review')                                               </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if(Session::get(SESSION_KEY_TMS) === 1 && Session::get(SESSION_KEY_LEVEL) === 3)
                                                <!-- addition -->
                                                <div class="col-lg-3"
                                                     id="check-note-update-food-brand-manage">
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-form-label">@lang('app.food-brand-manage.update.quantitative')</label>
                                                        <div class="col-lg-2">
                                                            <div class="checkbox-zoom zoom-primary">
                                                                <label>
                                                                    <input type="checkbox" id="quantitative-update-food-brand-manage">
                                                                    <span class="cr"><i
                                                                            class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(Session::get(SESSION_KEY_TMS) === 1 && Session::get(SESSION_KEY_LEVEL) === 3)
                                                <div class="col-lg-3 d-none" id="show-div-quantitative-update-food-brand-manage">
                                                    <div class="form-group ">
                                                        <label class="text text-warning text-right" id="text-quantitive-food">(*) 1 <span class="unit-name"></span>
                                                            <span class="food-name"></span> = 1 <span class="unit-material-name"></span> <span
                                                                class="material-name"></span></label>
                                                        <div class="col-lg-6 ">
                                                            <select id="material-update-food-brand-manage" class="js-example-basic-single"></select>
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
                </div>
            </div>
            <div class="modal-footer">

                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" id="btn-save-update-food-brand-manage"
                     onclick="saveModalAdditionUpdateFoodManage()"
                     onkeypress="saveModalAdditionUpdateFoodManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/update/addtion.js?version=11',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
