<div class="modal fade" id="modal-update-combo-food-brand-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom" id="loading-modal-update-combo-food-brand-manage">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.food-brand-manage.update.tab2')</h4>
                <button type="button" class="close ml-4" onclick="closeModalComboUpdateFoodManage()" onkeypress="closeModalComboUpdateFoodManage()">
                    <i class="fi-rr-cross"></i>
                </button>

            </div>
            <div class="modal-body text-left" id='tab-info-update-combo-food-manager'>
                <div class="row">
                    <div class="card-block card flex-sub">
                            <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15">
                                @lang('app.food-brand-manage.update.food-info')
                            </h6>
                            <div class="row pt-4">
                                <div class="col-lg-3 p-0 text-center">
                                    <div class="profile-thumb">
                                        <img class="profile-image-avatar" alt="" onerror="imageDefaultOnLoadError($(this))" src="{{asset('images/food_file.jpg', env('IS_DEPLOY_ON_SERVER'))}}"
                                             id="picture-update-combo-food-brand-manage" data-url-avt="" data-url-thumb style="border-radius: 50%;border: 3px solid #c1c1c1;width: 11rem;height: 11rem">
                                        <div class="edit-profile pointer" style="right: 45px">
                                            <label class="fileContainer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" id="input-picture-update-combo-food-brand-manage" accept="image/*">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 pt-1 px-0">
                                    <div class="row">
                                        <!--tên món-->
                                        <div class="form-group col-lg-6 m-0 validate-group">
                                            <div class="form-validate-input">
                                                <input id="name-update-combo-food-brand-manage" class="form-control"   data-emoji="1"
                                                       type="text" data-min-length="2" data-spec="1" data-max-length="50" data-empty="1">
                                                <label for="name-update-combo-food-brand-manage">
                                                    @lang('app.food-brand-manage.update.name')
                                                    @include('layouts.start')
                                                </label>
                                            </div>
                                        </div>
                                        <!--mã món-->
                                        <div class="form-group col-lg-6 m-0 validate-group">
                                            <div class="form-validate-input">
                                                <input id="code-update-combo-food-brand-manage" data-spec="1" data-emoji="1" disabled class="form-control" data-min-length="2" data-max-length="50">
                                                <label for="code-update-combo-food-brand-manage">
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
                                                            id="unit-update-combo-food-brand-manage">
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.food-brand-manage.update.unit')
                                                        @include('layouts.start') </label>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- category -->
                                        <div class="form-group col-lg-6 m-0 select2_theme validate-group">
                                            <div class="form-validate-select">
                                                <div class="select-material-box">
                                                    <select data-icon="fa-book" class="js-example-basic-single select2-hidden-accessible" data-select="1"
                                                            id="category-update-combo-food-brand-manage">
                                                    </select>
                                                    <label class="icon-validate">
                                                        @lang('app.food-brand-manage.update.category')
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12 select2_theme validate-group">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select id="note-update-combo-food-brand-manage" class="js-example-basic-single col-sm-12 select2-hidden-accessible" multiple=""></select>
                                                    <label class="icon-validate">
                                                        @lang('app.food-brand-manage.update.note-food')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- takeaway -->
                                        <div class="form-group  col-lg-12 d-none">
                                            <div class=" col-lg-12 form-group checkbox-group pl-0" >
                                                <label class="title-checkbox">@lang('app.food-brand-manage.update.take-away') </label>
                                                <div class="row" id="take-away-update-food-combo-brand-manage">
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name='take-combo' value="0" >
                                                            <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">@lang('app.food-brand-manage.update.option-no-take-away')
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name='take-combo' value="1">
                                                            <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">@lang('app.food-brand-manage.update.option-take-away')
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-validate-checkbox">
                                                        <div class="checkbox-form-group">
                                                            <input type="radio" name='take-combo' value="2">
                                                            <label class="name-checkbox" for="print-kitchen-create-food-brand-manage">@lang('app.food-brand-manage.update.option-take-all')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pt-1">
                                    <div class="row">
                                        <!-- ghi chú -->
                                        <div class="form-group validate-group w-100">
                                            <div class="form-validate-textarea">
                                                <div class="form__group pt-2">
                                                        <textarea id="description-update-combo-food-brand-manage" class="form__field"  style="min-height: 132px";
                                                                  rows="4" cols="1" data-note-max-length="1000"></textarea>
                                                    <label for="description-update-combo-food-brand-manage"
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
                                <div class="w-100" id='tab-combo-food-brand-manage'>
                                    <div class="row">
                                        <div class="col-lg-6 edit-flex-auto-fill px-0">
                                            <div class="card-block flex-sub mt-0 pl-0">
                                                <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15">
                                                    @lang('app.food-brand-manage.update.title-food-combo')
                                                </h6>
                                                <div class="table-responsive new-table pt-4 px-0">
                                                    <div class="select-filter-dataTable">
                                                        <div class="form-validate-select">
                                                            <div class="pr-0 select-material-box">
                                                                <select class="js-example-basic-single" id="select-food-in-combo-update-food-brand-manage"
                                                                        data-validate="">
                                                                    <option value="" disabled selected hidden>@lang('app.component.option-null')</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <table class="table table-bordered" id="table-food-in-combo-update-food-brand-manage" data-validate="table">
                                                        <thead>
                                                        <tr>
                                                            <th>@lang('app.food-brand-manage.update.name-table')</th>
                                                            <th>@lang('app.food-brand-manage.update.original-price')</th>
                                                            <th>@lang('app.food-brand-manage.update.quantity-table')</th>
                                                            <th>Thành tiền</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 edit-flex-auto-fill pr-0">
                                            <div class="card-block flex-sub col-lg-12 pr-0">
                                                <h6 class="sub-title m-b-0 f-w-600 col-form-lable-fz-15">
                                                    @lang('app.food-brand-manage.update.food-price')
                                                    <label class="text-lowercase text-warning mb-0">(*) Nhập giá chính xác sẽ cho báo cáo
                                                        chính xác </label>
                                                </h6>
                                                <div class="row col-lg-12 pt-4 px-0">
                                                    {{--  Giá Vốn --}}
                                                    <div class="form-group col-lg-6 m-0">
                                                        <div class="form-validate-input">
                                                            <input id="original-update-food-combo-brand-manage" class="form-control text-right" disabled="disabled">
                                                            <label>
                                                                @lang('app.food-brand-manage.update.original-price')
                                                                @include('layouts.start')
                                                            </label>
                                                        </div>
                                                        <div class="link-href">
                                                            <label class="text-warning">(*) @lang('app.food-brand-manage.update.sub-title-original-price') </label>
                                                        </div>
                                                    </div>
                                                    {{--  Giá bán --}}
                                                    <div class="form-group col-lg-6 m-0 validate-group">
                                                        <div class="form-validate-input">
                                                            <input id="price-update-combo-brand-manage" type="text" data-number="1"
                                                                   class="form-control text-right price-update-food-brand-manage border-0 w-100"
                                                                   data-min="1000" data-max="999999999">
                                                            <label for="price-update-combo-brand-manage">
                                                                @lang('app.food-brand-manage.update.price')
                                                                @include('layouts.start')
                                                            </label>
                                                        </div>
                                                        <div class="d-flex align-items-center mt-1 float-right">
                                                            @if( Session::get(SESSION_KEY_LEVEL) >= 8)
                                                                @lang('app.food-brand-manage.create.point'):
                                                                 <div style="width: auto" class="seemt-orange ml-1" id="point-update-combo-food-brand-manage">0</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!--lợi nhuận-->
                                                    <div class="form-group col-lg-6 validate-group">
                                                        <div class="form-validate-input">
                                                            <input type="text" class="form-control text-right" disabled id="profit-update-combo-food-brand-manage">
                                                            <label for="undefined">
                                                                @lang('app.food-brand-manage.update.profit')
                                                                @include('layouts.start')
                                                            </label>
                                                        </div>
                                                        <div class="d-flex align-items-center mt-1 float-right">
                                                            @lang('app.food-brand-manage.create.profit_margin')
                                                            @include('manage.food.brand.tooltip.profit_rate_by_price'):
                                                            <div style="width: auto" class="seemt-orange ml-1" id="profit-margin-update-combo-food-brand-manage">   0%</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6 select2_theme validate-group"
                                                         id="check-vat-update-combo-food-brand-manage">
                                                        <div class="form-validate-select ">
                                                            <div class="col-lg-12 mx-0 px-0">
                                                                <div class="col-lg-12 pr-0 select-material-box">
                                                                    <select id="vat-update-combo-food-brand-manage" class="js-example-basic-single col-sm-12 select2-hidden-accessible"></select>
                                                                    <label class="icon-validate">
                                                                        @lang('app.food-brand-manage.update.vat')</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- VAT -->
                                                    <div class="col-lg-4 d-none" id="show-div-quantitative-update-food-brand-manage">
                                                        <div class="form-group " >
                                                            <label class="text text-warning text-right" id="text-quantitive-food">(*) 1 <span class="unit-name"></span> <span class="food-name"></span> = 1 <span class="unit-material-name"></span> <span class="material-name"></span></label>
                                                            <div class="col-lg-6 " >
                                                                <select id="material-update-food-brand-manage" class="js-example-basic-single" ></select>
                                                            </div>
                                                        </div>
                                                    </div>
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

                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"  id="btn-save-update-food-brand-manage"
                     onclick="saveModalComboUpdateFoodManage()"
                     onkeypress="saveModalComboUpdateFoodManage()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/update/combo.js?version=10',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
