<div class="modal fade" id="modal-create-food-combo-brand-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom" id="loading-modal-create-food-combo-brand-manage">
            <div class="modal-header">
                <h4 class=" modal-title">@lang('app.food-brand-manage.create.title-combo')</h4>
                <button type="button" class="close ml-4" onclick="closeModalCreateFoodComboManage()" onkeypress="closeModalCreateFoodComboManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id='tab-info-create-food-combo-manager'>
                <div class="card">
                    <div class="row">
                        <div class="col-lg-12 edit-flex-auto-fill pr-1">
                            <div class="card-block flex-sub pb-0">
                                <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15">
                                    @lang('app.food-brand-manage.create.food-info')
                                </h6>
                                <div class="pt-4 row">
                                    <div class="col-lg-3 p-0 mb-4 text-center">
                                        <div class="profile-thumb">
                                            <img class="profile-image-avatar" alt=""
                                                 src="{{asset('images/food_file.jpg',env('IS_DEPLOY_ON_SERVER'))}}"
                                                 id="picture-create-food-combo-brand-manage" data-url-avt=""
                                                 data-url-thumb
                                                 style="border-radius: 50%;border: 3px solid #c1c1c1;width: 11rem; height: 11rem">
                                            <div class="edit-profile pointer" style="right: 45px">
                                                <label class="fileContainer">
                                                    <i class="fa fa-camera"></i>
                                                    <input type="file" id="input-picture-create-food-combo-brand-manage"
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
                                                    <input type="text" id="name-create-food-combo-brand-manage"
                                                           class="form-control" data-max-length="50" data-spec="1"
                                                             data-emoji="1" data-empty="1"
                                                           data-min-length="2">
                                                    <label for="name-create-food-brand-manage">
                                                        @lang('app.food-brand-manage.create.name')
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                            </div>
                                            <!--code-->
                                            <div class="form-group col-lg-6 m-0 validate-group">
                                                <div class="form-validate-input">
                                                    <input type="text" id="code-create-food-combo-brand-manage"
                                                           class="form-control" data-min-length="2" data-empty="1"
                                                           data-max-length="255" data-spec="1" data-emoji="1">
                                                    <label for="code-create-food-brand-manage">
                                                        @lang('app.food-brand-manage.create.code')
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- unit -->
                                            <div
                                                class="form-group col-lg-6 m-0 hidden-item class-combo-create-food-manage class-food-create-food-manage class-addition-create-food-manage class-gift-create-food-manage select2_theme validate-group">
                                                <div class="form-validate-select ">
                                                    <div class="col-lg-12 mx-0 px-0">
                                                        <div class="col-lg-12 pr-0 select-material-box">
                                                            <select data-icon="fa-book"
                                                                    class="js-example-basic-single select2-hidden-accessible"
                                                                    data-select="1"
                                                                    id="unit-create-food-combo-brand-manage"
                                                                    tabindex="-1" aria-hidden="true"></select>
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
                                                 id="id-combo-create-food-manage">
                                                <div class="form-validate-select ">
                                                    <div class="col-lg-12 mx-0 px-0">
                                                        <div class="col-lg-12 pr-0 select-material-box">
                                                            <select data-icon="fa-book"
                                                                    class="js-example-basic-single select2-hidden-accessible"
                                                                    data-select="1"
                                                                    id="category-create-food-combo-brand-manage"
                                                                    tabindex="-1" aria-hidden="true"></select>
                                                            <label class="icon-validate">
                                                                @lang('app.food-brand-manage.create.category')
                                                                @include('layouts.start')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--sở thích-->
                                            <div class="form-group col-lg-12 select2_theme validate-group"
                                                 id="check-note-create-food-brand-manage">
                                                <div class="form-validate-select ">
                                                    <div class="col-lg-12 mx-0 px-0">
                                                        <div class="col-lg-12 pr-0 select-material-box">
                                                            <select id="note-combo-food-brand-manage"
                                                                    class="col-sm-12 select-not-select2 select2-hidden-accessible"
                                                                    multiple="" tabindex="-1"
                                                                    aria-hidden="true"></select>
                                                            <label class="icon-validate">
                                                                @lang('app.food-brand-manage.create.note-food')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row pb-2 w-100 d-none">
                                            <!--hình thức bán-->
                                            <div class="form-group col-lg-12" style="margin-bottom: 0px !important;">
                                                <label class="title-checkbox"> @lang('app.food-brand-manage.create.take-away')</label>
                                                <div class="row"  id="take-away-create-food-combo-brand-manage">
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="take-combo" value="0"  data-icon="icofont-ui-file" checked >
                                                            <label class="name-checkbox"  >@lang('app.food-brand-manage.create.option-no-take-away')
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="take-combo" value="1"
                                                                   data-icon="icofont-ui-file" >
                                                            <label class="name-checkbox"  >@lang('app.food-brand-manage.create.option-take-away')
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name="take-combo" value="2"
                                                                   data-icon="icofont-ui-file">
                                                            <label class="name-checkbox"  >@lang('app.food-brand-manage.create.option-take-all')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  <!-- takeaway -->
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group validate-group w-100">
                                            <div class="form-validate-textarea">
                                                <div class="form__group pt-2">
                                                    <textarea rows="4" cols="1" id="description-create-food-combo-brand-manage" style="min-height: 132px"
                                                              data-note-max-length="1000"></textarea>
                                                    <label for="description-create-food-brand-manage">
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
                                @if(Session::get(SESSION_KEY_TMS) === 1 && Session::get(SESSION_KEY_LEVEL) === 3)
                                    <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15">
                                        @lang('app.food-brand-manage.create.food-admin')
                                    </h6>
                                    <div class="pt-4 row">
                                        <!-- print -->
                                        <div
                                            class="form-group col-lg-3 m-0 hidden-item class-food-create-food-manage class-combo-create-food-manage class-addition-create-food-manage">
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
                                            class="form-group  col-lg-3 m-0 hidden-item class-food-create-food-manage class-combo-create-food-manage class-addition-create-food-manage">
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
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 edit-flex-auto-fill">
                            <div class="card-block flex-sub py-0">
                                <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15">
                                    @lang('app.food-brand-manage.create.title-food-combo')
                                </h6>
                                <div class="table-responsive new-table pt-4 px-0">
                                    <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single"
                                                        id="select-food-in-combo-create-food-brand-manage">
                                                    <option value="" disabled selected
                                                            hidden>@lang('app.component.option-null')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered" id="table-food-combo-create-food-brand-manage">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.food-brand-manage.create.name-table')</th>
                                            <th>@lang('app.food-brand-manage.create.original-price')</th>
                                            <th>@lang('app.food-brand-manage.create.quantity-table')</th>
                                            <th>Thành tiền</th>
                                            <th></th>
                                            <th class="d-none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 edit-flex-auto-fill pr-1">
                            <div class="card-block flex-sub py-0">
                                <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15">
                                    @lang('app.food-brand-manage.create.food-price')
                                    <label class="text-lowercase text-warning mb-0">(*) Nhập giá chính xác sẽ cho báo
                                        cáo
                                        chính xác </label>
                                </h6>
                                <div class="row col-lg-12 pt-4 px-0">
                                    <div class="form-group col-lg-6 m-0">
                                        <div class="form-validate-input">
                                            <input id="original-create-food-combo-brand-manage"
                                                   class="form-control text-right"  disabled="disabled" value="0">
                                            <label>
                                                @lang('app.food-brand-manage.create.original-price')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href">
                                            <label
                                                class="text-warning">(*) @lang('app.food-brand-manage.create.sub-title-original-price') </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6 m-0 validate-group">
                                        <div class="form-validate-input">
                                            <input id="price-create-combo-brand-manage" type="text"
                                                   class="form-control text-right price-create-food-brand-manage"
                                                   value="0" data-number="1" data-min="1000" data-max="999999999"
                                                   data-type="currency-edit">
                                            <label for="price-create-combo-brand-manage">
                                                @lang('app.food-brand-manage.create.price')
                                                @include('layouts.start')

                                            </label>
                                        </div>
                                        <div class="d-flex align-items-center mt-1 float-right">
                                            @if( Session::get(SESSION_KEY_LEVEL) >= 8)
                                                @lang('app.food-brand-manage.create.point'):
                                                <div style="width: auto" class="seemt-orange ml-1" id="point-create-combo-food-brand-manage">0</div>
                                            @endif
                                        </div>
                                    </div>
                                    {{--lợi nhuận--}}
                                    <div class="form-group pt-2 col-lg-6 validate-group">
                                        <div class="form-validate-input">
                                            <input type="text" class="form-control text-right" disabled
                                                   id="profit-create-combo-food-brand-manage" value="0">
                                            <label for="undefined">
                                                @lang('app.food-brand-manage.create.profit')
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="d-flex align-items-center mt-1 float-right">
                                            @lang('app.food-brand-manage.create.profit_margin')
                                            @include('manage.food.brand.tooltip.profit_rate_by_price'):
                                            <div style="width: auto" class="seemt-orange ml-1" id="profit-margin-create-combo-food-brand-manage">0%</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pt-2">
                                        <div class="form-group select2_theme validate-group"
                                             id="check-vat-update-combo-food-brand-manage">
                                            <div class="form-validate-select ">
                                                <div class="select-material-box">
                                                    <select id="vat-create-combo-food-combo-brand-manage"
                                                            class="js-example-basic-single col-sm-12 select2-hidden-accessible"
                                                            tabindex="-1" aria-hidden="true"></select>
                                                    <label class="icon-validate">
                                                        @lang('app.food-brand-manage.update.vat')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- VAT -->
                                    </div>
                                    <div class="col-lg-4 d-none" id="show-div-quantitative-create-food-brand-manage">
                                        <div class="form-group ">
                                            <label class="text text-warning text-right" id="text-quantitive-food">(*) 1
                                                <span class="unit-name"></span> <span class="food-name"></span> = 1
                                                <span class="unit-material-name"></span> <span
                                                    class="material-name"></span></label>
                                            <div class="col-lg-6 ">
                                                <select id="material-create-food-brand-manage"
                                                        class="js-example-basic-single"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none"
                        onclick="resetModalCreateFoodComboManage()"
                        onkeypress="resetModalCreateFoodComboManage()" data-toggle="tooltip" data-placement="top"
                        data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveComboFoodCreateFoodBrandManage()"
                     onkeypress="saveComboFoodCreateFoodBrandManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/create/food_combo.js?version=26',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
