<div class="modal fade" id="modal-create-video-adv-marketing" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('app.media-restaurant.create-video.title')</h5>
                <div class="d-flex align-items-center">
                    <div class="input-group input-group-inverse float-right resize-select-header">
                            <span class="input-group-addon" id="div-upload-video-adv-marketing">
                                <i class="fa fa-folder-open"></i>
                            </span>
                        <input id="name-video-adv-marketing" type="text" class="form-control" placeholder="@lang('app.media-restaurant.create-video.sub-title-video')" data-empty="1">
                    </div>
                    <button type="button" class="close ml-4" onclick="closeModalCreateVideoAdvMarketing()" onkeypress="closeModalCreateVideoAdvMarketing()" fdprocessedid="mobvaa">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input class="d-none" type="file" id="upload-video-adv-marketing" accept="video/mp4">
                    <div class="col-12 text-center">
                        <video src="" id="data-upload-video-adv-marketing" data-src=""
                               class="custom-thumbnail-video-detail my-3" autoplay controls></video>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-custom">
                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" id="btn-save-upload-video-adv-marketing"
                        onclick="saveUploadVideoAdvMarketing()">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('js\marketing\media_restaurant\create_video.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
