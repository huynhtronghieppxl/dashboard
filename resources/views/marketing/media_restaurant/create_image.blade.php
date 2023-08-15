<div class="modal fade" id="modal-create-image-adv-marketing" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('app.media-restaurant.create-image.title')</h5>
                <button type="button" class="close" onclick="closeModalCreateImageAdvMarketing()" onkeypress="closeModalCreateImageAdvMarketing()" fdprocessedid="mobvaa">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="central-meta">
                    <div class="row merged5" id="data-upload-banner-adv-marketing">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="item-box" id="div-upload-banner-adv-marketing">
                                <div class="item-upload album">
                                    <i class="fa fa-plus-circle"></i>
                                    <div class="upload-meta">
                                        <h5>@lang('app.media-restaurant.create-image.sub-title-image')</h5>
                                        <span>@lang('app.media-restaurant.create-image.warning-message')</span>
                                    </div>
                                </div>
                            </div>
                            <input class="d-none" type="file" multiple id="upload-banner-adv-marketing" data-empty="1" name="file[]"
                                   accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-custom">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue"
                        onclick="saveUploadCreateImageAdvMarketing()" id="btn-save-upload-create-img-adv-marketing">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('js\marketing\media_restaurant\create_image.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
