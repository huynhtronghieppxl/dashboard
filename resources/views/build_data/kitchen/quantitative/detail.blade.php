<style>
    #modal-calc-detail-quantitative-data .number-type-title {
        font-size: inherit;
        padding-bottom: -16px;
        font-size: 26px;
    }

    #modal-calc-detail-quantitative-data .text-title {
        display: inline-table;
        word-spacing: 0px;
        word-break: break-word;
        max-width: 71px;
        margin-left: -7px;
        font-size: 10px !important;
    }

    #modal-calc-detail-quantitative-data .el-title {
        display: inline-table;
        word-spacing: 0px;
        word-break: break-word;
        max-width: 71px;
        margin-left: -7px;
    }

</style>
<div class="modal fade" id="modal-calc-detail-quantitative-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" id="tab-size">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết giá tiền định lượng</h5>
                <button type="button" class="close ml-4" onclick="closeModalDetailQuantitativeData()" onkeypress="closeModalDetailQuantitativeData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left">
            <div class="card card-block">
                    <div class="event-detailmeta">
                        <p style="color: #959ab5; font-size: 14px !important;text-align: left;">
                            @lang('app.material-data.create_calc.content')
                        </p>
                        <div class="text-center my-2 f-w-600">
                            <div class="row align-items-center justify-content-center py-2 text-secondary"
                                 style="color: #fa6342; border: 1px solid #ccc; font-size: 17px;border-style: dashed; border-radius: 11px">
                                <div class="col-lg-5 px-0">
                                    <lable class="number-type-title text-danger" id="total-material-calc">0
                                    </lable>
                                    <label class="text-title text-danger ml-0"> Giá tiền nguyên liệu định lượng</label>
                                    <label style="
                                        font-size: 20px !important;
                                        margin-left: 15px;
                                        margin-top: 40px;
                                    ">=</label>
                                </div>
                                <div class="col-lg-4 px-0">
                                    <div class="mb-0"
                                         style="border-bottom: 1px solid #d2d2d2; display: block; font-size: 17px">
                                        <label class="number-type-title"   id="price-material-calc">0</label>
                                        <label class="text-title"> Giá mua nguyên liệu</label></div>
                                    <div class="mt-1">
                                        <label class="mb-0" style="font-size: 17px">100% -</label>
                                        <label class="mb-0" id="percent-wastage-rate" style="font-size: 17px">0</label>
                                        <div class="mb-0" style="font-size: 17px;display: inline-block;">
                                            <label class="text-title ml-0"> Hao hụt</label></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 px-0" style="margin-top: 30px">
                                    <label class="el-title" style="font-size: 16px;margin-right: 9px;">X</label>
                                    <div style="display: inline-block;">
                                        <label class="number-type-title" id="quatity-material-calc">0</label>
                                        <label class="text-title ml-1">Số lượng định lượng</label></div>
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
    <script type="text/javascript" src="{{ asset('js\build_data\kitchen\quantitative\detail.js?version=15', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
