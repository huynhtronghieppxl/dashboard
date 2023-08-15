<div class="modal fade" id="modal-notify-change-status-cost-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="min-width: 70% !important;max-width: 70% !important;"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close ml-auto" onclick="closeModalNotifyCostData()" onkeypress="closeModalNotifyCostData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;"><div class="swal2-icon-content">!</div></div>
            <div class="text-center" style="font-size: 1.875em; font-weight: 500" id="title-change-status-cost-data"></div>
            <div class="modal-body pt-0" style="padding-top: 0 !important;background-color: #fff !important;">
                <h5 class="text-center" id="message-change-status-cost-data">Có phiếu chi đang được sử dụng hạng mục chi này. Bạn có chắc chắn muốn tạm ngưng?</h5>
                <div class="card-block">
                    <div class="table-responsive new-table">
                        <table class="table" id="table-change-status-cost-data">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã</th>
                                <th style="color: transparent">action</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue btn-change-unit-material" onclick="saveNotifyChangeStatusCost()">
                    <span>@lang('app.component.button.accept')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\revenue_and_cost\cost\notify.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
