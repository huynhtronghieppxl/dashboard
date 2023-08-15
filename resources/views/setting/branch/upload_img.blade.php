<div class="modal fade" id="modal-upload-image-branch" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.branch-setting.upload-img.title')</h4><h5 id="status-detail-material-data"></h5>
            </div>
            <div class="modal-body mb-0" id="loading-modal-update-branch-setting">
                <div class="row pointer" id="form-update-image-branch">
                    <div class="col-lg-12 col-md-6 col-sm-6">
                        <div class="smal-box">
                            <label class="fileContainer">
                                <i class="fa fa-file-image-o"></i>
                                <input type="file" multiple class="upload-image-branch" name="file[]">
                                <em></em>
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="sugested-photos d-none">
                    <ul class="sugestd-photo-caro ps-container ps-theme-default" style="height:100%;" id="list-image-branch-preview">
                    </ul>
                    <div class="ps-scrollbar-x-rail" style="left: 0; bottom: 0;">
                        <div class="ps-scrollbar-x" tabindex="0" style="left: 0; width: 0;">
                        </div>
                    </div>
                    <div class="ps-scrollbar-y-rail" style="top: 0; right: 0;">
                        <div class="ps-scrollbar-y" tabindex="0" style="top: 0; height: 0;">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect" onclick="closeModalUploadImageBranch()">
                    @lang('app.branch-setting.close-modal')
                </button>
                <button type="button" class="btn btn-primary waves-effect" onclick="updateListImageBranchSetting()">
                    @lang('app.branch-setting.save-modal')
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js\setting\branch\upload_img.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
