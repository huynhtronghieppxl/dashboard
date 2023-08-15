<div class="modal fade" id="modal-update-category-food-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.category-food-data.update.title')</h4>
                <button type="button" class="close" onclick="closeModalUpdateCategoryFoodData()" onkeypress="closeModalUpdateCategoryFoodData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-category-food-data">
                <div class="card-block card m-0">
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select ">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select id="type-update-category-food-data"
                                            class="js-example-basic-single select2-hidden-accessible">
                                        <option value="1">@lang('app.category-food-data.update.food')</option>
                                        <option value="2">@lang('app.category-food-data.update.drink')</option>
                                        <option value="3">@lang('app.category-food-data.update.other')</option>
                                    </select>
                                    <label class="icon-validate">
                                        @lang('app.category-food-data.update.type')
                                    </label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                            <input id="name-update-category-food-data" class="form-control" data-empty="1"
                                   data-min-length="2"  data-max-length="50" data-spec="1">
                            <label for="name-update-category-food-data">
                                @lang('app.category-food-data.update.name')
                                @include('layouts.start')
                            </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea class="form__field" id="description-update-category-food-data" cols="5"
                                          rows="3" data-note-max-length="2000"></textarea>
                                <label for="note-create-booking-table-manage" class="form__label icon-validate">
                                    @lang('app.category-food-data.update.description')
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
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveModalUpdateCategoryFoodData()"
                     onkeypress="saveModalUpdateCategoryFoodData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\food\category\update.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
