<style>
    .tooltip_formula{
        opacity: 0.9;
        position: relative;
    }
    /*.tooltip_formula:hover .tooltip_formula_wrapper{*/
    /*    display: block;*/
    /*}*/
    .tooltip_formula_wrapper{
        cursor: pointer;
        visibility: hidden;
        background: #333;
        position: absolute;
        top: 50%;
        right: 18px;
        transform: translateY(-50%);
        display: flex;
        width: max-content;
        color: white;
        align-items: center;
        padding: 4px;
        border-radius: 4px;
        gap: 10px;
        transition: .25s ease-in;
    }
    .tooltip_formula_wrapper:before{
        content: "";
        position: absolute;
        right: -4px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-top: 4px solid transparent;
        border-bottom: 4px solid transparent;
        border-left: 4px solid #333
    }
    .tooltip_formula:hover .tooltip_formula_wrapper{
        visibility: visible;
    }
</style>
<div class="modal fade" id="modal-detail-surcharge-sell-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">Chi tiết</h4>
                <h5 id="status-detail-discount-sell-report"></h5>
                <button type="button" class="close" onclick="closeModalDetailSurchargeSellReport()" onkeypress="closeModalDetailSurchargeSellReport()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body background-body-color" id="loading-modal-detail-surcharge-sell-report">
                <div class="row">
                    <div class="col-lg-12 edit-flex-auto-fill">
                        <div class="card card-block w-100">
                            <h5 class="text-bold sub-title">Danh sách hoá đơn</h5>
                            <div class="table-responsive new-table">
                                <table class="table" id="table-detail-surcharge-sell-report">
                                    <thead>
                                    <tr>
                                        <th>stt</th>
                                        <th>mã</th>
                                        <th>nhân viên</th>
                                        <th>bàn</th>
                                        <th>tổng tiền</th>
                                        <th>ngày thanh toán</th>
                                        <th>ghi chú</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
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
@include('manage.bill.detail')
@include('manage.food.brand.detail')
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('/js/report/sell/surcharge/detail.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
