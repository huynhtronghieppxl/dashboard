<div class="modal fade" id="modal-notify-change-status-area" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="max-width: 100% !important; width: 40em"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close ml-auto" onclick="closeModalNotifyAreaData()" onkeypress="closeModalNotifyAreaData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;"><div class="swal2-icon-content">!</div></div>
            <div class="text-center" style="font-size: 1.875em; font-weight: 500">
                Khu vực đang có bàn được sử dụng !
            </div>
            <div class="modal-body pt-0" style="padding-top: 0 !important;background-color: #fff !important;">
                <h5 id="title-change-area" class="text-justify font-weight-bold text-center"></h5>
                <div class=" card-block">
                    <div class="table-responsive new-table">
                        <table id="table-change-status-area-data" class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên bàn</th>
                                <th>Số lượng chỗ ngồi</th>
                                <th class="d-none"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div type="button" class="btn seemt-gray seemt-bg-gray seemt-btn-hover-gray btn-change-unit-material"  onclick="closeModalNotifyAreaData()">
                    <i class="fi-rr-cross"></i>
                    <span>Đóng</span>
                </div>
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue btn-change-unit-material"  onclick="saveConfirmPauseTableAreaData()">
                    <i class="fi-rr-check"></i>
                    <span>Đồng ý</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\business\area\notify.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
