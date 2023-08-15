<div class="modal fade" id="modal-detail-set-banner-advertisement" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-border">
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết banner</h4>
                <button type="button" class="close" onclick="closeModalDetailBanner()" onkeypress="closeModalDetailBanner()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-detail-set-banner-advertisement">
                <div class="card-border">
                    <div class="card card-block">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="col-lg-5">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Tên banner</p>
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="name-detail-set-banner-advertisement"></h6>
                                        </div>
                                        <div class="col-lg-12" id="type-set-banner-advertisement">
                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Loại banner</p>
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="type-detail-set-banner-advertisement"></h6>
                                        </div>
                                        <div class="col-lg-12" id="ulr-set-banner-advertisement">
                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Tên url</p>
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="url-detail-set-banner-advertisement"></h6>
                                        </div>
                                        <div class="col-lg-12 d-none" id="detail-reason-set-banner-advertisement">
                                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Lý do từ chối</p>
                                            <h6 class="text-muted f-w-400 col-form-label-fz-15" id="reason-detail-set-banner-advertisement"></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <form class="text-center">
                                        <div class="template-review-update-video">
                                            <div class="row div-box-video-restaurant">
                                                <div class="box-image-restaurant" style="max-height: 13rem !important;">
                                                    <img alt="" id="image-detail-banner-set-banner-advertisement" onerror="imageDefaultOnLoadError($(this))">
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
            <div class="modal-footer modal-footer-custom"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/banner/detail.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
