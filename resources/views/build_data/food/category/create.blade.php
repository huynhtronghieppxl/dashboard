<div class="modal fade" id="modal-create-category-food-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.category-food-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateCategoryFoodData()" onkeypress="closeModalCreateCategoryFoodData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-create-category-food-data">
                <div class="card-block card m-0">
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select data-icon="icofont icofont-options"
                                            class="js-example-basic-single select2-hidden-accessible"
                                            id="type-create-category-food-data">
                                        <option value="1">@lang('app.category-food-data.create.food')</option>
                                        <option value="2">@lang('app.category-food-data.create.drink')</option>
                                        {{--                                                    <option value="4">@lang('app.category-food-data.create.sea-food')</option>--}}
                                        <option value="3">@lang('app.category-food-data.create.other')</option>
                                    </select>
                                    <label class="icon-validate">
                                        @lang('app.category-food-data.create.type')
                                    </label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="name-create-category-food-data" class="form-control" data-empty="1"
                                   data-min-length="2" data-max-length="50" data-spec="1">
                            <label for="name-create-category-food-data">
                                @lang('app.category-food-data.create.name')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input form-left">
                            <input id="code-create-category-food-data" class="form-control" data-empty="1"
                                   data-min-length="2" data-max-length="50" data-spec="1">
                            <label for="code-create-category-food-data">
                                @lang('app.category-food-data.create.code')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea class="form__field" id="description-create-category-food-data" cols="5"
                                          rows="3" data-note-max-length="2000"></textarea>
                                <label for="description-create-category-food-data" class="form__label icon-validate">
                                    @lang('app.category-food-data.create.description')
                                </label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/300</span>
                                </div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew d-none" onclick="reloadModalCreateCategoryFoodData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalCreateCategoryFoodData()"
                     onkeypress="saveModalCreateCategoryFoodData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\food\category\create.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
