<div class="modal fade" id="modal-detail-notification" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.Notification.detail.title')</h4>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-detail-notificat">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-block">
                                <div class="card-body text-center">
                                    <img class="rounded-circle mb-4" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                                    <h4 class="font-weight-bold mb-4 text-center" style="font-size: font-size: 1.1rem;">Nguyễn Huy Dũng</h4>
                                    <hr>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="sub-title">Thông Báo</h5>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tiêu đề:</label>
                                    <label class="col-sm-7 col-form-label " id="employee_name"> Chỉnh Sửa </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nội dung: </label>
                                    <label class="col-sm-7 col-form-label " id="employee_name">Đã chỉnh sửa phiếu chi  </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-grd-disabled waves-effect" onclick="closeModalDetailNotification()">@lang('app.component.button.close')</button>
                    <button type="button" class="btn btn-primary waves-effect" >Xem chi tiết</button>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="id-detail-payroll-manage"></span>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\files\assets\js\notification\detail.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

