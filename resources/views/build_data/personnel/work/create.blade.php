<div class="modal fade" id="modal-create-work-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title create-work-data">@lang('app.work-data.create.title')</h4>
                <button type="button" class="close" onclick="closeModalCreateWorkData()" onkeypress="closeModalCreateWorkData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body create-work-data">
                <div class="card-block card m-0">
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select mb-0">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select class="js-example-basic-single select2-hidden-accessible"
                                            id="category-create-work-data">
                                    </select>
                                    <label class="icon-validate">
                                        @lang('app.work-data.create.category')@include('layouts.start')
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="link-href">
                            <span class="text text-warning">
                                @lang('app.work-data.tilte-add-category-1')
                                <a href="javascript:void(0)"
                                   class="text text-primary"
                                   onclick="openModalCreateWorkCategoryWorkData()">
                                    @lang('app.work-data.tilte-add-category-2')
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea type="text" class="form__field" id="name-create-work-data" cols="5" data-note-max-length="500"
                                          rows="5" placeholder="" data-empty="1" data-note="1"></textarea>
                                <label for="name-create-work-data" class="form__label icon-validate">
                                    @lang('app.work-data.create.name')
                                    @include('layouts.start')
                                </label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/500</span>
                                </div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea type="text" class="form__field" id="description-create-work-data" cols="5" data-note-max-length="2000"
                                          rows="5" placeholder=""></textarea>
                                <label for="description-create-work-data" class="form__label icon-validate">

                                    @lang('app.work-data.create.description')
                                </label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/2000</span>
                                </div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select mb-0">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select class="js-example-basic-single select2-hidden-accessible"
                                            id="kpi-create-work-data">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    <label class="icon-validate">
                                        @lang('app.work-data.create.kpi-point')
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-renew" onclick="reloadModalCreateWorkData()"
                        data-toggle="tooltip" data-placement="top" data-original-title="Đặt lại">
                    <i class="fa fa-eraser"></i>
                </button>
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveCreateWorkData()"
                     onkeypress="saveCreateWorkData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/personnel/work/create.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush


