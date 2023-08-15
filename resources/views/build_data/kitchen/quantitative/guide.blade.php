<div class="modal fade" id="modal-calc-guide-quantitative-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" id="tab-size">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết giá tiền định lượng</h5>
                <button type="button" class="close" onclick="closeModalGuideQuantitativeData()" onkeypress="closeModalGuideQuantitativeData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="card card-block">
                    <div class="event-guidemeta">
                        <p style="color: #959ab5; font-size: 14px !important;text-align: left;">
                            @lang('app.material-data.create_calc.content')
                        </p>
                        <div class="text-center my-2 f-w-600">
                            <div class="row align-items-center justify-content-center py-2"
                                 style="color: #fa6342; border: 1px solid #ccc; font-size: 17px;border-style: dashed; border-radius: 11px">
                                <div class="col-lg-5 px-0">
                                    Giá tiền nguyên liệu định lượng =
                                </div>
                                <div class="col-lg-4 px-0">
                                    <label class="mb-0"
                                           style="border-bottom: 1px solid #d2d2d2; display: block; font-size: 17px">Giá
                                        mua nguyên liệu</label>
                                    <label class="mb-0" style="font-size: 17px">100% - % Hao hụt</label></div>
                                <div class="col-lg-3 px-0">
                                    x Số lượng định lượng
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-custom">
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\kitchen\quantitative\guide.js?version=15', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
