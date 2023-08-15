<div class="modal fade" id="modal-upload-image-multi-file-food-manage" tabindex="-1" role="dialog" aria-hidden="true"
     data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h3 class="modal-title text-bold font-weight-bold">@lang('app.food_data.upload-image.title')</h3>
                <div class="d-flex align-items-center">

                    <span class="px-4">@lang('app.food_data.upload-image.file-size')<span class="text-danger">@lang('app.food_data.upload-image.user-manual-file-size')</span> </span>
                    <button type="button" class="close ml-4" onclick="closeModalUploadImgFoodManage()" >
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body text-left" id="loading-update-image-food-brand-manage">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="m-0">
{{--                            <div class="card-block pb-0">--}}
{{--                                <div class="form-group row mb-0">--}}
{{--                                    <div class="col-lg-4 mb-3">@lang('app.food_data.upload-image.file-size') <i--}}
{{--                                            class="text-danger">@lang('app.food_data.upload-image.user-manual-file-size')</i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="central-meta">
                                <div class="row merged5" id="data-upload-logo-create-food-brand-restaurant">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                        <div class="item-box mb-0" id="div-upload-logo-create-food-brand-restaurant" style="height: 12rem !important;">
                                            <div class="item-upload album">
                                                <i class="fa fa-plus-circle"></i>
                                                <div class="upload-meta">
                                                    <h5>@lang('app.food_data.upload-image.sub-up-file')</h5>
{{--                                                    <span>@lang('app.food_data.upload-image.sub-title')</span>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <input class="d-none" type="file" multiple id="upload-logo-create-food-brand-restaurant" name="file[]" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                     onclick="saveUploadImg()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.food_data.save-button')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/food/brand/upload_image.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
