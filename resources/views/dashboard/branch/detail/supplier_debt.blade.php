<div class="modal fade" id="modal-detail-supplier-debt-dashboard-report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document" id="tab-size">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CHI TIẾT CÔNG NỢ NHÀ CUNG CẤP
                    <span class="font-1-rem" id="employee-name-diligence-employee-off-manage"></span></h5>
            </div>
            <div class="modal-body text-left background-body-color pb-0">
                <div class="card-block card">
                    <div class="table-responsive new-table">
                        <table class="table"
                               id="table-detail-supplier-debt-dashboard-report">
                            <thead>
                            <tr>
                                <th class="text-center">Ngày</th>
                                <th class="text-center">Mã đơn hàng</th>
                                <th class="text-center">Diễn giải</th>
                                <th class="text-center">Số nợ tăng</th>
                                <th class="text-center">Số nợ giảm</th>
                                <th class="text-center">Còn nợ</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-custom">
                <button id="btn-close-create-material" type="button" class="btn btn-grd-disabled"
                        onclick="closeModalDetailSupplierDebtReport()">@lang('app.component.button.close')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\dashboard\branch\debt_report.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
