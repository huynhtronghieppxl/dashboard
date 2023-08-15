<div class="modal fade" id="modal-notify-change-status-unit" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="min-width: 70% !important;max-width: 70% !important;"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close ml-auto" onclick="closeModalNotifyUnitData()" onkeypress="closeModalNotifyUnitData()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;"><div class="swal2-icon-content">!</div></div>
            <div class="text-center" style="font-size: 1.875em; font-weight: 500">
                Nguyên liệu đang được sử dụng !
            </div>
            <div class="modal-body pt-0" style="padding-top: 0 !important;background-color: #fff !important;">
            <h5 class="text-center font-weight-bold text-center  ">Bạn không thể tắt đơn vị này vì có nguyên liệu đang sử dụng nó. Bạn vui lòng đổi đơn vị và quy cách mới cho các nguyên liệu bên dưới trước khi tắt đơn vị này!</h5>
            <div class=" card-block">
                <div class="table-responsive new-table">
                    <table id="table-change-status-unit-data" class="table">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên nguyên liệu</th>
                            <th>Đơn vị</th>
                            <th>Quy cách</th>
                            <th></th>
                            <th class="d-none"  ></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <div type="button" class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-none btn-change-unit-material"  >
                    <i class="fi-rr-disk"></i>
                    <span>@lang('app.component.button.save')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\build_data\material\unit\notify.js?version=8', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
