<div class="modal fade" id="detail-procedure" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg-big" role="document">
        <div class="modal-content" id="loading-modal-history-manage">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.brand-setting.procedure.title')</h4>
            </div>
            <div class="card card-block mt-0 bg-white-border">
                <div class="row mt-2">
                    <div class="col-lg-6">
                        <div class="w-100">
                            <div class="row">
                                <div class="form-group select-procedure-create-restaurant">
                                    <h5 class="text-bold sub-title mb-1 ml-0 col-form-label-fz-15 f-w-600">@lang('app.brand-setting.procedure.name')</h5>
                                    <form>
                                        <div class="radio radiofill radio-primary radio-inline"
                                             style="width: calc(100% / 1) !important;">
                                            <div class="form-validate-checkbox">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" name="radio-size" value="1" checked>
                                                    <label class="name-checkbox">
                                                        @lang('app.brand-setting.procedure.first')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="radio radiofill radio-info radio-inline"
                                             style="width: calc(100% / 1) !important;">
                                            <div class="form-validate-checkbox">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" name="radio-size" value="2">
                                                    <label class="name-checkbox">
                                                        @lang('app.brand-setting.procedure.second')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="radio radiofill radio-warning radio-inline"
                                             style="width: calc(100% / 1) !important;">
                                            <div class="form-validate-checkbox">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" name="radio-size" value="3">
                                                    <label class="name-checkbox">
                                                        @lang('app.brand-setting.procedure.third')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="w-100">
                            <div class="row">
                                <div class="form-group select-option-create-restaurant">
                                    <h5 class="text-bold sub-title mb-1 ml-0 col-form-label-fz-15 f-w-600">@lang('app.brand-setting.procedure.option')</h5>
                                    <form>
                                        <div class="radio radiofill radio-primary radio-inline"
                                             style="width: calc(100% / 1) !important;">
                                            <div class="form-validate-checkbox">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" name="radio-option" value="1" checked>
                                                    <label class="name-checkbox">
                                                        @lang('app.brand-setting.procedure.option1')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="radio radiofill radio-info radio-inline"
                                             style="width: calc(100% / 1) !important;">
                                            <div class="form-validate-checkbox">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" name="radio-option" value="2">
                                                    <label class="name-checkbox">
                                                        @lang('app.brand-setting.procedure.option2')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="radio radiofill radio-warning radio-inline d-none"
                                             style="width: calc(100% / 1) !important;">
                                            <div class="form-validate-checkbox">
                                                <div class="checkbox-form-group">
                                                    <input type="radio" name="radio-option" value="3">
                                                    <label class="name-checkbox">
                                                        @lang('app.brand-setting.procedure.option3')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class=" form-group col-lg-12">
                            <img id="get-image-detail-procedure" style="width: 100%; height: 100%;"
                                 src="https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416346996843.png">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-btn-hover-gray seemt-bg-gray-w200" data-dismiss="modal" id="btn_close_create"
                     onclick="closeModalHistory()">
                    <i class="fi-rr-cross"></i>
                    <span>@lang('app.brand-setting.close-modal')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
{{--    <script type="text/javascript" src="{{asset('js/setting/brand/index.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>--}}
@endpush
