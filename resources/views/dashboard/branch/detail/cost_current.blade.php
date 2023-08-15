<div class="modal fade" id="modal-detail-cost-current-branch-report" data-keyboard="false"
     data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="title-detail-cost-current-branch-report"></h4>
            </div>
            <div class="modal-body background-body-color">
                <div class="card quater-card">
                    <div class="card-block">
                        <h3 class="h3 m-b-20">Chi phí thực tế</h3>
                        <h4 id="total-detail-cost-current">0</h4>
                        <h4 class="h4 m-t-30">Chi phí các hạng mục chi đã chi
                            <a href="javascript:void(0)" class="showmore underline-detail text-primary"
                               onclick="openModalDetailOtherCostRevenueCostProfit()">Chi tiết</a>
                        </h4>
                        <h4 class="h4 text-muted" id="total-payment-cost-current">0<span class="f-right">0%</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-warning" id="rate-payment-cost-current"
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
                        <h4 class="h4 text-muted" id="total-debt-cost-current">0<span class="f-right">0%</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-danger" id="rate-debt-cost-current" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled"
                        onclick="closeModalDetailCostCurrent()">@lang('app.component.button.close')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\dashboard\branch\detail\cost_current.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
