<div class="modal fade" id="modal-detail-one-get-one-campaign" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết CHƯƠNG TRÌNH KHUYẾN MÃI</h4>
                <button type="button" class="close" onclick="closeDetailOneGetOneMarketing()" onkeypress="closeDetailOneGetOneMarketing()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-detail-one-get-one-campaign">
                <div class="row">
                    <div class="col-sm-12 col-lg-6 edit-flex-auto-fill px-0">
                        <div class="card card-block flex-sub">
                            <div class="form-group cover-profile">
                                <div class="profile-bg-img bg-white-border box-image bg-white" id="branch-cover-image" style="height: auto">
                                    <figure class="box-image-banner-branch" style="height: auto !important;">
                                        <div class="edit-pp ">
                                            <label class="fileContainer pointer">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" accept="image/*" id="upload-banner-one-get-one-campaign">
                                            </label>
                                        </div>
                                        <img id="thumbnail-detail-one-get-one-campaign" src="{{asset('/images/tms/default.jpeg',env('IS_DEPLOY_ON_SERVER'))}}" alt="" style="height: 210px">
                                    </figure>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">GIỜ BẮT ĐẦU</p>
                                    <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="time-from-detail-one-get-one-campaign">0</h6>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">GIỜ KẾT THÚC</p>
                                    <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="time-to-detail-one-get-one-campaign">0</h6>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">NGÀY BẮT ĐẦU</p>
                                    <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="date-from-detail-one-get-one-campaign">0</h6>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">NGÀY KẾT THÚC</p>
                                    <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="date-to-detail-one-get-one-campaign">0</h6>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">NGÀY ÁP DỤNG</p>
                                    <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="date-apply-one-get-one-campaign">user, Phường Đức Xuân, Thị Xã Bắc Kạn, Tỉnh Bắc Kạn</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 edit-flex-auto-fill pr-0">
                        <div class="card card-block mx-0 flex-sub">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">TÊN CHƯƠNG TRÌNH</p>
                                    <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="name-detail-one-get-one-campaign">0</h6>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">CHI NHÁNH</p>
                                    <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="branch-detail-one-get-one-campaign">0</h6>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12">
                                    <p class="m-b-10 f-w-600 col-form-label-fz-15">CHI TIẾT CHƯƠNG TRÌNH</p>
                                    <h6 class="text-muted f-w-400 reset-data-detail-employee-manage col-form-label-fz-15" id="detail-info-detail-one-get-one-campaign">0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/marketing/campaign/one_get_one/detail.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
