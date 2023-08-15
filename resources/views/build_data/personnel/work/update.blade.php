<div class="modal fade" id="modal-update-work-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title update-work-data">@lang('app.work-data.update.title')</h4>
                <button type="button" class="close ml-4" onclick="closeModalUpdateWorkData()" onkeypress="closeModalUpdateWorkData()">
                    <i class="fi-rr-cross"></i>
                </button>

            </div>
            <div class="modal-body update-work-data">
                <div class="card-block card m-0">
                    <div class="form-group select2_theme validate-group">
                        <div class="form-validate-select">
                            <div class="col-lg-12 mx-0 px-0">
                                <div class="col-lg-12 pr-0 select-material-box">
                                    <select class="select-not-select2 select2-hidden-accessible"
                                            id="category-update-work-data">
                                    </select>
                                    <label class="icon-validate">
                                        @lang('app.work-data.update.category')
                                        @include('layouts.start')
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea class="form__field" id="name-update-work-data" rows="5" cols="5" data-note-max-length="500" data-note-min-length="2"
                                          data-note="1"></textarea>
                                <label for="name-update-work-data" class="form__label icon-validate">
                                    @lang('app.work-data.update.name')
                                    @include('layouts.start')
                                </label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/300</span>
                                </div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-textarea">
                            <div class="form__group pt-2">
                                <textarea class="form__field" id="description-update-work-data" rows="5" data-note-max-length="2000"
                                          cols="5"></textarea>
                                <label for="description-update-work-data" class="form__label icon-validate">
                                    @lang('app.work-data.update.description')
                                </label>
                                <div class="textarea-character" id="char-count">
                                    <span>0/300</span>
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
                                            id="kpi-update-work-data">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    <label class="icon-validate">
                                        @lang('app.work-data.create.kpi-point')
                                        @include('layouts.start')
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveUpdateWorkData()"
                     onkeypress="saveUpdateWorkData()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/work/update.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush


