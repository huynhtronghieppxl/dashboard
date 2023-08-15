<div class="modal fade" id="modal-detail-revenue-cost-profit-branch-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="title-detail-revenue-cost-profit-branch-report"></h4>
            </div>
            <div class="modal-body" id="loading-modal-detail-payment-bill">
                <div class="table-responsive new-table card-block">
                    <table class="table" id="table-detail-revenue-cost-profit-branch-report">
                        <thead>
                        <tr>
                            <th rowspan="2">STT</th>
                            <th rowspan="2">Chi nhánh</th>
                            <th rowspan="2">Mã phiếu</th>
                            <th rowspan="2">Người tạo</th>
                            <th rowspan="2">Đối tượng</th>
                            <th rowspan="2">Hạng mục</th>
                            <th rowspan="2">Thời gian</th>
                            <th>Số tiền</th>
                            <th rowspan="2">Trạng thái</th>
                            <th rowspan="2"></th>
                        </tr>
                        <tr>
                            <th id="total-amount-detail-revenue-cost-profit-branch-report"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled"
                        onclick="closeModalDetailRevenueCostProfit()">@lang('app.component.button.close')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\dashboard\dashboard_sale_solution\detail\revenue_cost_profit.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
