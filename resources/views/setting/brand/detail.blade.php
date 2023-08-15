<div class="modal fade" id="modal-detail" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg-big" role="document">
        <div class="modal-content" id="loading-modal-history-manage">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.brand-setting.paradigm.title')</h4>
            </div>
            <div class="card-block bg-white-border mt-0">
                <div class="card-block-left-right row">
                    <div class="col-lg-6 p-0">
                        <div class="form-group col-lg-12 select-option-size-create-restaurant">
                            <h5 class="text-bold sub-title mb-1 ml-0 col-form-label-fz-15 f-w-600">@lang('app.brand-setting.paradigm.name')</h5>
                            <form>
                                <div class="radio radiofill radio-primary radio-inline"
                                     style="width: calc(100% / 1) !important;">
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="radio-size" value="1" checked>
                                            <label class="name-checkbox">
                                                @lang('app.brand-setting.paradigm.small')                                                    </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="radio radiofill radio-info radio-inline"
                                     style="width: calc(100% / 1) !important;">
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="radio-size" value="2">
                                            <label class="name-checkbox">
                                                @lang('app.brand-setting.paradigm.medium')                                      </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="radio radiofill radio-warning radio-inline"
                                     style="width: calc(100% / 1) !important;">
                                    <div class="form-validate-checkbox">
                                        <div class="checkbox-form-group">
                                            <input type="radio" name="radio-size" value="3">
                                            <label class="name-checkbox">
                                                @lang('app.brand-setting.paradigm.large')                                      </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="">
                            <img id="get-image-option-create-restaurant"
                                onerror="imageDefaultOnLoadError($(this))" src="{{asset('/images/tms/default.jpeg', env('IS_DEPLOY_ON_SERVER'))}}">
{{--                                onerror="imageDefaultOnLoadError($(this))" src="https://beta.storage.aloapp.vn/public/resource/TMS/FOOD/0/0/1/2022/6/8-6-2022/image/original/web-1654693836-small.jpg">--}}
                        </div>
                    </div>
                </div>
                <div class="form-group row col-lg-12 select-option-size-create-restaurant align-items-center justify-content-center">
                    <label class="font-weight-bold col-form-label col-form-label-price-setting-brand">@lang('app.brand-setting.paradigm.price') </label>
                 <span class="d-inline ml-2 price-detail-setting-brand" id="price-detail-brand"></span>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-btn-hover-gray seemt-bg-gray-w200" data-dismiss="modal" id="btn_close_create"
                     onclick="closeDetail()">
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
