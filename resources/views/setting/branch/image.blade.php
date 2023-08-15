<div class="card">
    <div class="col-lg-12 m-auto">
        <div class="row card-block p-0 float-right m-3" t="">
            <button type="button" class="btn btn-danger waves-effect mr-2 btn-remove-all-image-branch d-none"
                    onclick="removeAllImage()">@lang('app.component.branch-setting.upload-img.remove')
            </button>
            <button type="button" class="btn btn-Success waves-effect mr-2 btn-select-all-image"
                    onclick="selectAllImage($(this))">@lang('app.component.branch-setting.upload-img.choose-all')
            </button>
            <button type="button" class="btn btn-primary waves-effect mr-2" onclick="openUploadImageBranch()">@lang('app.component.branch-setting.upload-img.add-img')
            </button>
        </div>
    </div>
</div>
<div class="card">
    <div class="list-images-branch-setting" id="animated-thumbnails-gallery">
    </div>
    <!-- </section> -->
    <div class="lightbox">
        <div class="title"></div>
        <div class="filter"></div>
        <div class="arrowr"></div>
        <div class="arrowl"></div>
        <div class="close"></div>
    </div>
    <div class="form-group row text-center">
        <form enctype='multipart/form-data'
              method='POST'>
            <input class="d-none" type='file'
                   name='files[]'
                   multiple
                   id="upload-images-branch-setting"/>
        </form>
    </div>
</div>
