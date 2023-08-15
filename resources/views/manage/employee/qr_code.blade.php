<div class="modal fade" id="modal-qr-create-employee-manage" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.employee-manage.qr.title')</h4>
                <button type="button" class="close" onclick="closeModalQrCodeEmployeeManage()" onkeypress="closeModalQrCodeEmployeeManage()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="card card-block">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div id="code-qr-employee-manage" class="text-center"></div>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group col-sm-12">
                                    <div class="col-sm-5 sub-title">
                                        <h6 class="font-weight-bold">@lang('app.employee-manage.qr.name') :</h6>
                                    </div>
                                    <div class="col-sm-7 sub-title">
                                        <h6 class="font-weight-bold" id="name-qr-employee-manage"></h6>
                                    </div>
                                </div>
                                <div class="input-group col-sm-12">
                                    <div class="col-sm-5 sub-title">
                                        <h6 class="font-weight-bold">@lang('app.employee-manage.qr.restaurant') :</h6>
                                    </div>
                                    <div class="col-sm-7 sub-title">
                                        <h6 class="font-weight-bold" id="restaurant-qr-employee-manage"></h6>
                                    </div>
                                </div>
                                <div class="input-group col-sm-12">
                                    <div class="col-sm-5 sub-title">
                                        <h6 class="font-weight-bold">@lang('app.employee-manage.qr.username') :</h6>
                                    </div>
                                    <div class="col-sm-7 sub-title">
                                        <h6 class="font-weight-bold" id="username-qr-employee-manage"></h6>
                                    </div>
                                </div>
                                <div class="input-group col-sm-12">
                                    <div class="col-sm-5 sub-title">
                                        <h6 class="font-weight-bold">@lang('app.employee-manage.qr.password') :</h6>
                                    </div>
                                    <div class="col-sm-7 sub-title">
                                        <h6 class="font-weight-bold" id="password-qr-employee-manage"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
