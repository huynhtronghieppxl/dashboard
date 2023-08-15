<div class="modal fade" id="modal-update-banner-branch-setting" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="loading-update-banner-branch-setting">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.branch-setting.update_banner.title')</h4>
            </div>

            <div class="modal-body px-5 mb-0" id="loading-modal-update-branch-setting">
                <div class="card-block">
                    <div class="form-group row">
                        <span class="col-lg-8 px-0">@lang('app.branch-setting.update.tabs.image-urls-tab.photo-format')
                            <span class="text-danger">@lang('app.branch-setting.update.type-img')</span>.
                                @lang('app.branch-setting.update.tabs.image-urls-tab.size-format')
                            <span class="text-danger">@lang('app.branch-setting.update.tabs.image-urls-tab.size')</span>
                        </span>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="dropzone2 dropzone-customs text-center py-2"
                                          method="post" id="upload-img-update-food-manage">
                                        @csrf
                                        <div id="previews-banner-update">
                                            <div class="template-review-update" id="template-review-update">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                        <img class="avatar-md avatar-sm avatar-lg avatar-xl"
                                                             data-dz-thumbnail id="thumbnail-banner">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                                    <button class="btn btn-grd-warning mt-2 dz-clickable" id="clickable-dropzone-update">
                                        @lang('app.food-manage.update.btn-image')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect" onclick="closeModalUpdateBannerBranchSetting()">
                    @lang('app.branch-setting.close-modal')
                </button>
                <button type="button" class="btn btn-primary waves-effect" id="save-update-banner-branch-setting">
                    @lang('app.branch-setting.save-modal')
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js\setting\branch_v2\update_banner.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
