<div class="modal fade" id="modal-list-unfinished_order" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="max-width: 100% !important; width: 40em" role="document">
        <div class="modal-content" id="">
            <div class="modal-header">
                <button type="button" class="close ml-auto" onclick="closeModalListUnfinishedOrder()"
                        onkeypress="closeModalListUnfinishedOrder()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                <div class="swal2-icon-content">!</div>
            </div>
            <div class="text-center" style="font-size: 18px; font-weight: 600;" id="title-list-unfinished_order">
                VUI LÒNG HOÀN TẤT CÁC PHIẾU SAU TRƯỚC KHI TẠO KIỂM KÊ</div>
            <div class="modal-body pt-0 mx-auto" style="padding-top: 0 !important;background-color: #fff !important;">
                <h5 class="text-center" id="message-list-unfinished_order" style="font-size: 14px;">
                    Hoàn tất các đơn hàng, phiếu nhập, xuất kho chi nhánh, phiếu nhập kho bộ phận dưới đây để tạo kiểm kê</h5>
                <div class="card-block">
                    <div class="table-responsive new-table">
                        <table class="table" id="table-list-unfinished_order">
                            <thead>
                            <tr>
                                <th class="text-center">@lang('app.material-data.notify.stt')</th>
                                <th class="text-left">Mã đơn</th>
                                <th></th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/manage/inventory/checklist_goods/unfinished_order.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
