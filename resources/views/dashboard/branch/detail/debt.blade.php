<div class="modal fade" id="modal-detail-debt-revenue-cost-profit-report" data-keyboard="false"
     data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">Danh sách phiếu chi công nợ</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-detail-debt-revenue-cost-profit-report">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Chi nhánh</th>
                            <th>Mã phiếu</th>
                            <th>Người tạo</th>
                            <th>Nhà cung cấp</th>
                            <th>Hạng mục</th>
                            <th>Thời gian</th>
                            <th>Số tiền</th>
                            <th>Trạng thái</th>
                            <th>Chi tiết</th>
                        </tr>
                        <tr>
                            <th colspan="2">Tổng cộng</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th id="total-detail-debt-revenue-cost-profit-report"></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled"
                        onclick="closeModalDetailDebtRevenueCostProfit()">@lang('app.component.button.close')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\dashboard\branch\detail\debt.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
