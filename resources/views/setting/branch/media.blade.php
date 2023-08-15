<head>
    <link href="{{ asset('css/css_custom/setting_branch/media.css') }}" rel="stylesheet">
    <style>
    </style>
</head>

<div class="card-block">
    <div id="div-folder-setting-branch" class="filter-bar">
        <button class="btn btn-primary border-radius-6-px" id="create-folder-setting-branch">
            <i class="fa fa-plus"></i>
            @lang('app.branch-setting.add-folder')
        </button>
        <div class="search-layout-body" style="background-color: #fff; border: 0.12rem solid rgb(183 183 183); border-radius: 10px;">
            <input class="search-text-layout-body" type="text" placeholder="@lang('app.branch-setting.search-folder')" id="search-folder-setting-branch" />
            <a href="javascript:void(0)" class="search-button-layout-body" id="btn-search-history-layout"><i class="fa fa-search"></i></a>
        </div>

        <div class="row" id="data-folder-setting-branch" style="margin-right: -15px !important;
    margin-left: -15px !important;"></div>
    </div>
    <div id="div-media-setting-branch" class="d-none">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4 id="name-folder-media-setting-branch" data-id="">...</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="central-meta">
            <div class="row merged5" id="data-media-setting-branch">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" id="create-media-setting-branch">
                    <div class="item-box">
                        <div class="item-upload album">
                            <i class="fa fa-plus-circle"></i>
                            <div class="upload-meta">
                                <h5>@lang('app.component.branch-setting.upload')</h5>
                                <span>@lang('app.component.branch-setting.few-second')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav aria-label="..." id="nav-media-setting-branch" class="nav-control-setting-branch">
        <div class="simple-pagination"></div>
    </nav>
</div>
<div class="modal fade" id="modal-create-media-setting-branch" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.branch-setting.upload-img.title')</h4><h5
                    id="status-detail-material-data"></h5>
            </div>
            <div class="modal-body mb-0" id="loading-modal-update-branch-setting">
                <div class="central-meta">
                    <div class="row merged5" id="data-upload-media-setting-branch">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="item-box" id="div-upload-media-setting-branch">
                                <div class="item-upload album">
                                    <i class="fa fa-plus-circle"></i>
                                    <div class="upload-meta">
                                        <h5>@lang('app.component.branch-setting.upload')</h5>
                                        <span>@lang('app.component.branch-setting.few-second')</span>
                                    </div>
                                </div>
                            </div>
                            <input class="d-none" type="file" multiple id="upload-media-setting-branch" name="file[]">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled waves-effect" onclick="closeModalUploadMediaBranch()">
                    @lang('app.component.button.close')
                </button>
                <button type="button" class="btn btn-primary waves-effect" onclick="saveModalUploadMediaBranch()">
                    @lang('app.component.button.save')
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js\setting\branch\media.js?version=7', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript" src="{{asset('js\setting\branch\upload_media.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush


