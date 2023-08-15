<div class="modal fade" id="modal-detail-other-cost-revenue-cost-profit-report" data-keyboard="false"
     data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">Danh sách hạng mục chi khác</h4>
            </div>
            <div class="modal-body">
                <div class="card-block">
                    <div class="table-responsive new-table">
                        <table class="table" id="table-detail-other-cost-revenue-cost-profit-report">
                            <thead>
                            <tr>
                                <th rowspan="2">STT</th>
                                <th rowspan="2">Hạng mục</th>
                                <th>Số tiền</th>
                                <th rowspan="2"></th>
                            </tr>
                            <tr>
                                <th id="total-detail-other-cost-revenue-cost-profit-report"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grd-disabled"
                        onclick="closeModalDetailOtherCostRevenueCostProfit()">@lang('app.component.button.close')</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\dashboard\dashboard_sale_solution\detail\other_cost.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
