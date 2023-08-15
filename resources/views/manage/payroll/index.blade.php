@extends('layouts.layout') @section('content')
    <style>
        .select2-container--default .select2-dropdown .select2-search__field {
            width: 100% !important;
        }

        .seemt-container .new-table .checkbox-form-group {
            justify-content: center !important;
        }

        .seemt-main-content .new-table .toolbar-button-datatable1 > label {
            font-size: 13px !important;
            margin-top: 0px !important;
            margin-bottom: 16px !important;
        }

        .seemt-main-content .new-table .toolbar-button-datatable1 label {
            display: flex;
            flex-direction: row !important;
            justify-content: center !important;
            align-items: center !important;
            padding: 8px 16px !important;
            height: 32px !important;
            background: #E3ECF5;
            border-radius: 6px !important;
            flex: none !important;
            order: 1 !important;
            flex-grow: 0 !important;
            border: none !important;
            text-transform: uppercase;
            margin-bottom: 10px !important;
        }

        .new-table .toolbar-button-datatable1 {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="table-responsive new-table">
                    <div class="select-filter-dataTable">
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single select-brand">
                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                        @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                            <option value="{{$db['id']}}"
                                                    selected>{{$db['name']}}</option>
                                        @else
                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single select-branch">
                                    @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                                        @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                                            <option value="{{$db['id']}}"
                                                    selected>{{$db['name']}}</option>
                                        @else
                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="time-filer-dataTale">
                            <input id="time-payroll-manage" class="input-datetimepicker" type="text"
                                   value="{{date('m/Y')}}"/>
                            <button id="search-time-payroll-manage"><i class="fi-rr-filter"></i></button>
                        </div>
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single" id="select-role-payroll-manage">
                                    <option value="" selected="">@lang('app.payroll-manage.department')</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-validate-select">
                            <div class="pr-0 select-material-box">
                                <select class="js-example-basic-single" id="select-status-payroll-manage">
                                    <option value="0,1,2,3,4,5,6,7" selected>@lang('app.payroll-manage.status')</option>
                                    <option value="0">@lang('app.payroll-manage.option-pending')</option>
                                    <option value="1">@lang('app.payroll-manage.option-employee-confirm')</option>
                                    <option value="2">@lang('app.payroll-manage.option-manage-confirm')</option>
                                    <option value="3">@lang('app.payroll-manage.option-general-manage-confirm')</option>
                                    <option value="4">@lang('app.payroll-manage.option-waiting-approved')</option>
                                    <option value="5">@lang('app.payroll-manage.option-approved')</option>
                                    <option value="6">@lang('app.payroll-manage.option-paid')</option>
                                    <option value="7">@lang('app.payroll-manage.option-denied')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table class="table" id="table-data-payroll">
                        <thead>
                        <tr>
                            <th rowspan="3">@lang('app.payroll-manage.stt')</th>
                            <th rowspan="3" class="text-left">@lang('app.payroll-manage.employee_name')</th>
                            <th rowspan="3">@lang('app.payroll-manage.shift')</th>
                            <th rowspan="2">
                                @lang('app.payroll-manage.leave')<br>
                                @lang('app.payroll-manage.get_paid')
                            </th>
                            <th rowspan="2">
                                @lang('app.payroll-manage.leave')<br>
                                @lang('app.payroll-manage.not_salary')
                            </th>
                            <th rowspan="2">@lang('app.payroll-manage.leave-not_allowed')</th>
                            <th rowspan="2">@lang('app.payroll-manage.KPI_point')</th>
                            <th rowspan="2" class="text-right">@lang('app.payroll-manage.basic_salary')</th>
                            <th rowspan="2">@lang('app.payroll-manage.work_day')</th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.salary')<br>
                                <span style="border-top: 1px solid;">@lang('app.payroll-manage.work_day')</span><br>
                                @lang('app.payroll-manage.salary_number_1')
                            </th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.bonus')<br>
                                @lang('app.payroll-manage.DBH')<br>
                                @lang('app.payroll-manage.salary_number_2')
                            </th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.bonus')<br>
                                @lang('app.payroll-manage.booking')<br>
                                @lang('app.payroll-manage.salary_number_3')
                            </th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.bonus')<br>
                                @lang('app.payroll-manage.kaizen')<br>
                                @lang('app.payroll-manage.salary_number_4')

                            </th>
                            <th rowspan="2">
                                @lang('app.payroll-manage.quantity')<br>
                                @lang('app.payroll-manage.new_customer')
                            </th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.bonus')<br>
                                @lang('app.payroll-manage.new_customer')<br>
                                @lang('app.payroll-manage.salary_number_5')<br>

                            </th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.other_bonus')<br>
                                @lang('app.payroll-manage.salary_number_6')
                            </th>
                            <th rowspan="2">
                                @lang('app.payroll-manage.food_review')<br>
                                @lang('app.payroll-manage.kitchen_pellets')<br>
                                @lang('app.payroll-manage.salary_number_7')
                            </th>
                            <th rowspan="2">
                                @lang('app.payroll-manage.food_review')<br>
                                @lang('app.payroll-manage.kitchen_main')<br>
                                @lang('app.payroll-manage.salary_number_8')
                            </th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.support')<br>
                                @lang('app.payroll-manage.salary_number_9')
                            </th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.total')<br>
                                @lang('app.payroll-manage.salary_increase')<br>
                                @lang('app.payroll-manage.salary_number_10')
                            </th>
                            <th colspan="3">
                                @lang('app.payroll-manage.punish_from_salary')
                            </th>

                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.total')<br>
                                @lang('app.payroll-manage.punish')<br>
                                @lang('app.payroll-manage.salary_number_14')
                            </th>

                            <th colspan="3">
                                @lang('app.payroll-manage.decrease_from_salary')
                            </th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.total_decrease_salary')<br>
                                @lang('app.payroll-manage.salary_number_18')
                            </th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.total_decrease')<br>
                                @lang('app.payroll-manage.salary_number_19')
                            </th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.total_salary')<br>
                                @lang('app.payroll-manage.salary_number_20')
                            </th>
                            <th rowspan="2" class="text-right">
                                @lang('app.payroll-manage.reality_received')<br>
                                @lang('app.payroll-manage.salary_number_21')
                            </th>
                            <th rowspan="3" class="text-right">@lang('app.payroll-manage.status')</th>
                            <th rowspan="3" class="text-right">@lang('app.payroll-manage.option')</th>
                            <th rowspan="3">
                                <div class="toolbar-button-datatable1 align-items-start">
                                    <label onclick="confirmSalaryPayrollMutiEmployee()"
                                           class="mb-1 pointer mr-1 d-flex align-items-center d-none check-confirm-salary-muti-employee  ">
                                        <span class="mr-1">Xác nhận</span>
                                    </label>
                                    <label onclick="cancelConfirmSalaryPayrollMutiEmployee()"
                                           class="mb-1 pointer mr-1 d-flex align-items-center d-none cancel-confirm-salary-muti-employee  ">
                                        <span class="mr-1">Hủy</span>
                                    </label>
                                </div>
                                <div class="checkbox-form-group d-none  checkbox-all-salary-treasure  "
                                     style="align-content: end !important;margin-left: 20px  ">
                                    <input type="checkbox" id="checkbox-all-salary">
                                    <p id="total-count-confirm-salary"></p>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th style="font-size: 12px;padding: 5px;">
                                @lang('app.payroll-manage.punish_late')<br>
                                @lang('app.payroll-manage.salary_number_11')
                            </th>
                            <th style="font-size: 12px;padding: 5px;">
                                @lang('app.payroll-manage.punish_not')<br>
                                @lang('app.payroll-manage.check_out')<br>
                                @lang('app.payroll-manage.salary_number_12')
                            </th>
                            <th style="font-size: 12px;padding: 5px;">
                                @lang('app.payroll-manage.punish_other')<br>
                                @lang('app.payroll-manage.salary_number_13')
                            </th>
                            <th>
                                @lang('app.payroll-manage.decrease')<br>
                                @lang('app.payroll-manage.salary_number_15')
                            </th>
                            <th>
                                @lang('app.payroll-manage.advance')<br>
                                @lang('app.payroll-manage.salary_number_16')
                            </th>
                            <th>
                                @lang('app.payroll-manage.bill_debt')<br>
                                @lang('app.payroll-manage.salary_number_17')
                            </th>
                        </tr>
                        <tr>
                            <th class="seemt-fz-14" id="leave_allowed"></th>
                            <th class="seemt-fz-14" id="leave_of_absence"></th>
                            <th class="seemt-fz-14" id="leave_not_allow"></th>
                            <th class="seemt-fz-14" id="kpi_point"></th>
                            <th class="seemt-fz-14" id="base_salary_after_increase"></th>
                            <th class="seemt-fz-14" id="work_day"></th>
                            <th class="seemt-fz-14" id="salary_based_on_workday"></th>
                            <th class="seemt-fz-14" id="sale_point_bonus"></th>
                            <th class="seemt-fz-14" id="bonus_booking"></th>
                            <th class="seemt-fz-14" id="bonus_kaizen"></th>
                            <th class="seemt-fz-14" id="customer_new"></th>
                            <th class="seemt-fz-14" id="customer_bonus"></th>
                            <th class="seemt-fz-14" id="other_bonus"></th>
                            <th class="seemt-fz-14" id="kitchen_staff_evaluate_food"></th>
                            <th class="seemt-fz-14" id="chef_evaluate_food"></th>
                            <th class="seemt-fz-14" id="support"></th>
                            <th class="seemt-fz-14" id="total_bonus"></th>
                            <th class="seemt-fz-14" id="excessive_late_fines"></th>
                            <th class="seemt-fz-14" id="excessive_fines_without_check_out"></th>
                            <th class="seemt-fz-14" id="other_punish"></th>
                            <th class="seemt-fz-14" id="total_punish_amount"></th>
                            <th class="seemt-fz-14" id="uniform_money"></th>
                            <th class="seemt-fz-14" id="pre_paid_amount"></th>
                            <th class="seemt-fz-14" id="debt_wrong_bill"></th>
                            <th class="seemt-fz-14" id="total_salary_reduce"></th>
                            <th class="seemt-fz-14" id="total_punish"></th>
                            <th class="seemt-fz-14" id="total_salary"></th>
                            <th class="seemt-fz-14" id="total_temporary_salary"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none">
        <span id="title-verify">@lang('app.payroll-manage.title-verify')</span>
        <span id="title-owner-verify">@lang('app.payroll-manage.title-owner-verify')</span>
        <span id="text-owner-verify">@lang('app.payroll-manage.text-owner-verify')</span>
        <span id="success-verify">@lang('app.payroll-manage.success-verify')</span>
        <span id="error-verify">@lang('app.payroll-manage.error-verify')</span>
        <span id="success-owner-verify">@lang('app.payroll-manage.success-owner-verify')</span>
        <span id="success-owner-salary">@lang('app.payroll-manage.success-owner-salary')</span>
        <span id="error-export-excel">@lang('app.payroll-manage.error-export-excel')</span>
        <span id="title-denied-salary">@lang('app.salary-employee.title-denied-salary')</span>
        <span id="content-denied-salary">@lang('app.salary-employee.content-denied-salary')</span>
        <span id="error-denied-salary">@lang('app.salary-employee.error-denied-salary')</span>
    </div>
    @include('manage.payroll.detail')
    @include('manage.payroll.excel')
    @include('manage.payroll.notify')
    @include('manage.employee.info')
    @include('manage.payroll.update')
@endsection @push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/payroll/index.js?version=3',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
