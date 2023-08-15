<div class="modal fade" id="modal-detail-advance-salary-employee" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card-shadow-custom">
            <div class="modal-header">
                <h4 class="modal-title text-center">Chi tiết chi ứng lương</h4>
                <div class="d-flex">
                    <h5 id="status-detail-advance-salary-employee"></h5>
                    <button type="button" class="close ml-4" onclick="closeModalDetailAdvanceSalaryEmployee()" onkeypress="closeModalDetailAdvanceSalaryEmployee()">
                        <i class="fi-rr-cross"></i>
                    </button>
                </div>
            </div>

            <div class="modal-body" id="loading-modal-detail-advance-salary-employee">
                <div class="card-block card">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Tên nhân viên</p>
                            <div class="d-flex mb-1">
                                <img class="image-size-detail img-radius" src=""
                                     id="avatar-employee-detail-advance-salary-employee"
                                     onerror="this.src='/images/tms/default.jpeg'">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                    id="employee-detail-advance-salary-employee" style="margin: auto 5px">---</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12" id="approved-detail-advance-salary-employee-div">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Người duyệt</p>
                            <div class="d-flex mb-1">
                                <img class="image-size-detail img-radius" src=""
                                     id="avatar-employee-approved-detail-advance-salary-employee"
                                     onerror="this.src='/images/tms/default.jpeg'">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                    id="employee-approved-detail-advance-salary-employee" style="margin: auto 5px">---</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12" id="paid-detail-advance-salary-employee-div">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Người chi</p>
                            <div class="d-flex mb-1">
                                <img class="image-size-detail img-radius" src=""
                                     id="avatar-employee-paid-detail-advance-salary-employee"
                                     onerror="this.src='/images/tms/default.jpeg'">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                    id="employee-paid-detail-advance-salary-employee" style="margin: auto 5px">---</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 d-none" id="cancel-detail-advance-salary-employee-div">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Người từ chối</p>
                            <div class="d-flex mb-1">
                                <img class="image-size-detail img-radius" src=""
                                     id="avatar-employee-cancel-detail-advance-salary-employee"
                                     onerror="this.src='/images/tms/default.jpeg'">
                                <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                    id="employee-cancel-detail-advance-salary-employee" style="margin: auto 5px">---</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Số tiền</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="amount-detail-advance-salary-employee">0</h6>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Ngày ứng</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                id="time-detail-advance-salary-employee">0</h6>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-6">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Lý do</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                style="word-break: break-all"
                                id="reason-detail-advance-salary-employee">0</h6>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-6 d-none" id="cancel_reason-detail-advance-salary-employee-div">
                            <p class="m-b-10 f-w-600 col-form-label-fz-15">Lý do từ chối</p>
                            <h6 class="text-muted f-w-400 col-form-label-fz-15 reset-data-detail-payment-bill"
                                style="word-break: break-all"
                                id="cancel_reason-detail-advance-salary-employee">0</h6>
                        </div>
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
            src="{{ asset('js/treasurer/advance_salary_employee/detail.js?version=3',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
