<div class="modal fade" id="modal-notify-change-status-material" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="min-width: 70% !important;max-width: 70% !important;" role="document">
        <div class="modal-content d-none" id="table-change-status-enable-material-food-data">
            <div class="modal-header">
                <button type="button" class="close ml-auto" onclick="closeModalNotifyMaterialData()"
                        onkeypress="closeModalNotifyMaterialData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                <div class="swal2-icon-content">!</div>
            </div>
            <div class="text-center" style="font-size: 1.875em; font-weight: 500" id="title-change-status-material-food-data">@lang('app.material-data.notify.title')</div>
            <div class="modal-body pt-0" style="padding-top: 0 !important;background-color: #fff !important;">
                <h5 class="text-center font-weight-bold" id="message-change-status-material-food-data"></h5>
                <div class="card-block">
                    <div class="table-responsive new-table">
                        <table class="table" id="table-change-status-material-food-data">
                            <thead>
                            <tr>
                                <th class="text-center">@lang('app.material-data.notify.stt')</th>
                                <th class="text-left">@lang('app.material-data.notify.food_name')</th>
                                <th class="text-left">@lang('app.material-data.notify.material')</th>
                                <th></th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue btn-change-unit-material"  onclick="changeStatusMaterialConfirm()">
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.accept')</span>
                </div>
            </div>
        </div>

        <div class="modal-content d-none" id="table-change-status-enable-material-order-data" style="max-width: 100% !important;width: 40em;margin: 0 auto;">
            <div class="modal-header">
                <button type="button" class="close ml-auto" onclick="closeModalNotifyMaterialData()"
                        onkeypress="closeModalNotifyMaterialData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                <div class="swal2-icon-content">!</div>
            </div>
            <div class="text-center" style="font-size: 1.875em; font-weight: 500" id="title-change-status-material-order-data">Nguyên liệu đang có đơn hàng</div>
            <div class="modal-body pt-0" style="padding-top: 0 !important;background-color: #fff !important;">
                <h5 class="text-center font-weight-bold" id="message-change-status-material-order-data"></h5>
                <div class="card-block">
                    <div class="table-responsive new-table">
                        <table class="table" id="table-change-status-material-order-data">
                            <thead>
                            <tr>
                                <th class="text-left">@lang('app.material-data.notify.stt')</th>
                                <th class="text-left">Mã đơn</th>
                                <th class="text-left">Tên NCC</th>
                                <th></th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\material\material\notify.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
