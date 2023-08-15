<style>
    .div-box-video-restaurant {
        position: relative;
        width: 100%;
        margin: 0 auto 20px auto;
        cursor: pointer;
        overflow: hidden;
        border-radius: 1rem;
        box-shadow: 0 0 0.5rem;
    }

    .box-image-restaurant {
        position: relative;
        width: 100%;
        height: 20rem;
        margin: 0;
        z-index: 1;
        max-height: 20rem;
    }

    .box-video-restaurant video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .box-image-restaurant img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

</style>
<div class="modal fade" id="modal-update-set-banner-advertisement" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content card-border">
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa banner</h4>
                <button type="button" class="close" onclick="closeModalUpdateBanner()" onkeypress="closeModalUpdateBanner()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-update-set-banner-advertisement">
                <div class="card-border">
                    <div class="card card-block">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="col-lg-6">
                                    <div class="form-group validate-group">
                                        <div class="form-validate-input">
                                            <input id="name-update-set-banner-advertisement" data-empty="1" data-min-length="2" data-max-length="50" class="form-control">
                                            <label for="name-update-set-banner-advertisement">
                                                Tên banner
                                                @include('layouts.start')
                                            </label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group select2_theme validate-group">
                                        <div class="form-validate-select ">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="type-update-banner-manage" data-select="1" class="js-example-basic-single">
                                                        <option value="2" selected>WEB</option>
                                                        <option value="1">QUÀ TẶNG</option>
                                                        <option value="0">KHO BEER</option>
                                                    </select>
                                                    <label class="icon-validate">
                                                        Loại
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group validate-group"  id="update-box-url-banner-manage">
                                        <div class="form-validate-input">
                                            <input id="url-update-set-banner-advertisement" data-tooltip="1" class="form-control">
                                                <label>Tên url</label>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group select2_theme validate-group d-none" id="update-box-gift-banner-manage">
                                        <div class="form-validate-select ">
                                            <div class="col-lg-12 mx-0 px-0">
                                                <div class="col-lg-12 pr-0 select-material-box">
                                                    <select id="gift-update-banner-manage" data-select="1" class="js-example-basic-single">
                                                        <option disabled selected>Vui lòng chọn</option>
                                                    </select>
                                                    <label class="icon-validate">
                                                        Chọn quà
                                                        @include('layouts.start')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="link-href"></div>
                                    </div>
                                    <div class="form-group row text-center pt-3">
                                        <div class="col-lg-12 mt-3">
                                            <div class="row">
                                                <div class="col-lg-8 border px-0" style=" border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                                                    <label class="col-lg-12 text-muted mt-3">
                                                        <label>Banner định dạng</label>
                                                        <label class="text-danger pl-1">png, jpeg, jpg</label>
                                                        <label>. Kích thước không quá</label>
                                                        <label class="text-danger pl-1">10MB</label>
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 border pb-2 d-flex align-items-center justify-content-center" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;" >
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label class="btn seemt-orange seemt-bg-orange seemt-btn-hover-orange seemt-fz-14 mt-3">
                                                                <input type="file" id="upload-update-set-banner-advertisement" class="d-none" accept="image/*">
                                                                Chọn ảnh Banner
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <form class="text-center">
                                        <div class="template-review-update-video">
                                            <div class="row div-box-video-restaurant">
                                                <div class="box-image-restaurant">
                                                    <img alt="" id="image-update-banner-set-banner-advertisement" onerror="imageDefaultOnLoadError($(this))" data-src="">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-custom">
                <div id="btn-update-card-value"  type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue" onclick="saveModalUpdateBanner()" onkeypress="saveModalUpdateBanner()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.title-button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/banner/update.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
