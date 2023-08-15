<div class="modal fade" id="modal-detail-cost-branch-report" data-keyboard="false"
     data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="title-detail-cost-branch-report"></h4>
            </div>
            <div class="modal-body background-body-color">
                <div class="card quater-card">
                    <div class="card-block">
                        <h3 class="h3 m-b-20">Chi phí tổng</h3>
                        <h4 id="total-detail-cost">0</h4>
                        <h4 class="h4 m-t-30">Chi phí đơn hàng</h4>
                        <h4 class="h4 text-muted" id="total-order-cost">0<span class="f-right">0%</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-primary" id="rate-order-cost" style="width: 0%"></div>
                        </div>
                        <h4 class="h4 m-t-30">Chi phí lương</h4>
                        <h4 class="h4 text-muted" id="total-salary-cost">0<span class="f-right">0%</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-success" id="rate-salary-cost" style="width: 0%"></div>
                        </div>
                        <div class="m-l-50 w-50">
                            <h5 class="h5 m-t-30 m-l-0">Lương thực lãnh (Những ngày đã diễn ra)</h5>
                            <h4 class="h4 text-muted" id="total-current-salary-cost">0<span
                                    class="f-right">0%</span></h4>
                            <div class="progress">
                                <div class="progress-bar bg-instagram" id="rate-current-salary-cost"
                                     style="width: 0%"></div>
                            </div>
                            <h5 class="h5 m-t-30 m-l-0">Lương ước tính (Những ngày chưa diễn ra, tính theo lương cơ
                                bản)</h5>
                            <h4 class="h4 text-muted" id="total-estimate-salary-cost">0<span
                                    class="f-right">0%</span></h4>
                            <div class="progress">
                                <div class="progress-bar bg-info" id="rate-estimate-salary-cost"
                                     style="width: 0%"></div>
                            </div>
                        </div>
                        <h4 class="h4 m-t-30">Chi phí các hạng mục chi khác
                            <div class="tool-box" style="width: max-content; display: inline-block"
                                 data-toggle="tooltip" data-placement="top"
                                 data-original-title="Không bao gồm các phiếu chi lương và phiếu chi cho Nhà cung cấp">
                                <i class="fa fa-exclamation-circle"></i>
                            </div>
                            <a href="javascript:void(0)" class="showmore underline-detail"
                               onclick="openModalDetailOtherCostRevenueCostProfit()">Chi tiết</a>
                        </h4>
                        <h4 class="h4 text-muted" id="total-payment-cost">0<span class="f-right">0%</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-warning" id="rate-payment-cost"
                                 style="width: 0%"></div>
                        </div>
                        <h4 class="h4 m-t-30">Chi phí công nợ
                            <div class="tool-box" style="width: max-content; display: inline-block"
                                 data-toggle="tooltip" data-placement="top"
                                 data-original-title="Bao gồm các phiếu chi công nợ (tức phiếu chi cho các đơn hàng trước đó)">
                                <i class="fa fa-exclamation-circle"></i>
                            </div>
                            <a href="javascript:void(0)" class="showmore underline-detail"
                               onclick="openModalDetailDebtRevenueCostProfit()">Chi tiết</a>
                        </h4>
                        <h4 class="h4 text-muted" id="total-debt-cost">0<span class="f-right">0%</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-danger" id="rate-debt-cost" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled"
                        onclick="closeModalDetailCost()">@lang('app.component.button.close')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\dashboard\dashboard_sale_solution\detail\cost.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
