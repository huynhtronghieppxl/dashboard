<div class="modal fade" id="modal-payroll" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('app.payroll-manage.title_detail') <span
                            class="span-covert-size-parent date-detail">{{date('m/Y')}}</span></h4>
                <button type="button" class="close" onclick="closeModalDetail()" onkeypress="closeModalDetail()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body text-left" id="loading-modal-detail-payroll-manage">
                <div class="row m-0">
                    <div class="col-lg-12 p-0">
                        <ul class="nav nav-tabs md-tabs md-5-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" onclick=""
                                   name="tabchange" href="#tab0-payroll-manage-detail" role="tab"
                                   id="tab-table-in"
                                   aria-expanded="true">@lang('app.payroll-manage.detail.info')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" onclick=""
                                   name="tabchange" href="#tab1-payroll-manage-detail" role="tab"
                                   id="tab-table-in"
                                   aria-expanded="true">@lang('app.payroll-manage.detail.punish') <span
                                        class="label label-warning"
                                        id="total-record-punish-payroll-manage">0</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" onclick=""
                                   name="tabchange" href="#tab2-payroll-manage-detail" role="tab"
                                   id="tab-table-out"
                                   aria-expanded="false">@lang('app.payroll-manage.detail.point')
                                    <span
                                        class="label label-success"
                                        id="total-record-point-payroll-manage">0</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" onclick=""
                                   name="tabchange" href="#tab3-payroll-manage-detail" role="tab"
                                   id="tab-table-out"
                                   aria-expanded="false">@lang('app.payroll-manage.detail.check-in') <span
                                        class="label label-primary"
                                        id="total-record-check-in-payroll-manage">0</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" onclick=""
                                   name="tabchange" href="#tab4-payroll-manage-detail" role="tab"
                                   id="tab-table-out"
                                   aria-expanded="false">@lang('app.payroll-manage.detail.debt') <span
                                        class="label label-danger"
                                        id="total-record-debit-payroll-manage">0</span></a>
                            </li>
                        </ul>
                        <div class="card m-0" style="margin-top: -1px">
                            <div class="tab-content">
                                <div class="card-block tab-pane active money-fund-in p-0" id="tab0-payroll-manage-detail" role="tabpanel" aria-expanded="true">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4 edit-flex-auto-fill">
                                            <div class="card flex-sub">
                                                <div class="card-block p-0 m-0">
                                                    <h5 class="sub-title" id="boxlist1-tab0-payroll-manage-detail">@lang('app.payroll-manage.info_detail')</h5>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.fullname_detail')</label>
                                                        <label class="col-sm-7 col-form-label text-right class-link" id="employee_name"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.department_detail')</label>
                                                        <label class="col-sm-7 col-form-label text-right" id="employee_department"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.kpi_detail')</label>
                                                        <label class="col-sm-7 col-form-label text-right" id="employee_kpi"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.basic_salary_detail')</label>
                                                        <label class="col-sm-7 col-form-label text-right" id="employee_base_salary"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.real_salary_detail')</label>
                                                        <label class="col-sm-7 col-form-label text-right"
                                                               id="employee_reality_salary"></label>
                                                    </div>
                                                    <div class="form-group row d-none" id="cancel_reason_salary_div">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">Lý do từ chối</label>
                                                        <label class="col-sm-7 col-form-label text-right"
                                                               id="cancel_reason_salary"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 edit-flex-auto-fill">
                                            <div class="card flex-sub">
                                                <div class="card-block h-100 p-0 m-0">
                                                    <h5 class="sub-title" id="boxlist2-tab0-payroll-manage-detail">@lang('app.payroll-manage.bonus_detail')</h5>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.support_detail')</label>
                                                        <label class="col-sm-7 col-form-label text-right" id="employee_support"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.food_bonus')</label>
                                                        <label class="col-sm-7 col-form-label text-right" id="employee_food_bonus"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.figure_bonus')</label>
                                                        <label class="col-sm-7 col-form-label text-right"
                                                               id="employee_figure_bonus"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.other_bonus')</label>
                                                        <label class="col-sm-7 col-form-label text-right"
                                                               id="employee_other_bonus"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-12 col-form-label">&emsp;</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4 edit-flex-auto-fill">
                                            <div class="card flex-sub">
                                                <div class="card-block p-0 m-0">
                                                    <h5 class="sub-title" id="boxlist3-tab0-payroll-manage-detail">@lang('app.payroll-manage.fines_detail')</h5>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.orther_punish')</label>
                                                        <label class="col-sm-7 col-form-label text-right" id="employee_punish"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.uniform_detail')</label>
                                                        <label class="col-sm-7 col-form-label text-right" id="employee_uniform"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.debt_wrong_bill_detail')</label>
                                                        <label class="col-sm-7 col-form-label text-right" id="employee_in_debt"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.advance_payment_detail')</label>
                                                        <label class="col-sm-7 col-form-label text-right" id="employee_bonus"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.late_detail')</label>
                                                        <label class="col-sm-7 col-form-label text-right" id="employee_late"></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label
                                                            class="col-sm-5 col-form-label f-w-600">@lang('app.payroll-manage.without_checkout_detail')</label>
                                                        <label class="col-sm-7 col-form-label text-right"
                                                               id="employee_no_check_out"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-block tab-pane money-fund-in" id="tab1-payroll-manage-detail" role="tabpanel" aria-expanded="true">
                                    <div class="table-responsive new-table">
                                        <table class="table"
                                               id="table-payroll-manage-detail-tab1">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.stt')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.date')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.type')</th>
                                                    <th >@lang('app.payroll-manage.detail.amount')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.note')</th>
                                                </tr>
                                                <tr>
                                                    <th id="total-payroll-manage-detail-tab1">0</th>
                                                    <th class="d-none"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-block tab-pane money-fund-out" id="tab2-payroll-manage-detail" role="tabpanel" aria-expanded="false">
                                    <div class="table-responsive new-table">
                                        <table class="table" id="table-payroll-manage-detail-tab2">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.stt')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.order')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.rank')</th>
                                                    <th>@lang('app.payroll-manage.detail.amount-tab2')
                                                        <br>@lang('app.payroll-manage.detail.note-1')</th>
                                                    <th>@lang('app.payroll-manage.detail.rank-amount')
                                                        <br>@lang('app.payroll-manage.detail.note-2')</th>
                                                    <th>@lang('app.payroll-manage.detail.point')
                                                        <br>@lang('app.payroll-manage.detail.note-3')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.date')</th>
                                                </tr>
                                                <tr>
                                                    <th
                                                        id="amount-payroll-manage-detail-tab2"></th>
                                                    <th
                                                        id="rank-payroll-manage-detail-tab2"></th>
                                                    <th
                                                        id="total-payroll-manage-detail-tab2">0
                                                    </th>
                                                    <th class="d-none"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-block tab-pane money-fund-out" id="tab3-payroll-manage-detail"
                                     role="tabpanel" aria-expanded="false">
                                    <div class="table-responsive new-table">
                                        <table class="table"
                                               id="table-payroll-manage-detail-tab3">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.stt')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.date')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.working-name')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.time')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.working-in')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.working-out')</th>
                                                    <th>@lang('app.payroll-manage.detail.working-minutes')</th>
                                                </tr>
                                                <tr>
                                                    <th
                                                        id="total-payroll-manage-detail-tab3">0
                                                    </th>
                                                    <th class="d-none"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-block tab-pane money-fund-out" id="tab4-payroll-manage-detail"
                                     role="tabpanel" aria-expanded="false">
                                    <div class="table-responsive new-table">
                                        <table class="table"
                                               id="table-payroll-manage-detail-tab4">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.stt')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.order')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.table-name')</th>
                                                    <th>@lang('app.payroll-manage.detail.amount')</th>
                                                    <th rowspan="2">@lang('app.payroll-manage.detail.date')</th>
                                                    <th class="d-none"></th>
                                                </tr>
                                                <tr>
                                                    <th
                                                        id="total-payroll-manage-detail-tab4">0
                                                    </th>
                                                    <th class="d-none"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="id-detail-payroll-manage"></span>
</div>
@include('manage.employee.info')
{{--@include('manage.bill.detail')--}}
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/payroll/detail.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

