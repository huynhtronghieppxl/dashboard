<table id="table-export-payroll-manage" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style=" background-color: #a2c4c9;" colspan="32">@lang('app.payroll-manage.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="32">@lang('app.payroll-manage.excel.text2'): <span id="brand-excel-salary"></span> -
            @lang('app.payroll-manage.excel.text3'): <span id="branch-excel-salary"></span></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="32"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="32" id="title-excel-payroll-manage" style="background-color: #c5c5c5">@lang('app.payroll-manage.excel.text4')
            <span></span></th>
    </tr>
    <tr>
        <th class="title_header_excel" rowspan="3">@lang('app.payroll-manage.stt')</th>
        <th class="title_header_excel" rowspan="3">@lang('app.payroll-manage.employee_name')</th>
        <th class="title_header_excel" rowspan="3">@lang('app.payroll-manage.department_detail')</th>
        <th class="title_header_excel" rowspan="3">@lang('app.payroll-manage.shift')</th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.leave')
            @lang('app.payroll-manage.get_paid')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.leave')
            @lang('app.payroll-manage.not_salary')
        </th>
        <th class="title_header_excel" rowspan="2">@lang('app.payroll-manage.leave-not_allowed')</th>
        <th class="title_header_excel" rowspan="2">@lang('app.payroll-manage.KPI_point')</th>
        <th class="title_header_excel" rowspan="2">@lang('app.payroll-manage.basic_salary')</th>
        <th class="title_header_excel" rowspan="2">@lang('app.payroll-manage.work_day')</th>
        <th class="title_header_excel" rowspan="2">
            Lương/ngày công @lang('app.payroll-manage.salary_number_1')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.bonus')
            @lang('app.payroll-manage.DBH')
            @lang('app.payroll-manage.salary_number_2')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.bonus')
            @lang('app.payroll-manage.booking')
            @lang('app.payroll-manage.salary_number_3')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.bonus')
            @lang('app.payroll-manage.kaizen')
            @lang('app.payroll-manage.salary_number_4')

        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.quantity')
            @lang('app.payroll-manage.new_customer')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.bonus')
            @lang('app.payroll-manage.new_customer')
            @lang('app.payroll-manage.salary_number_5')

        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.other_bonus')
            @lang('app.payroll-manage.salary_number_6')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.food_review')
            @lang('app.payroll-manage.kitchen_pellets')
            @lang('app.payroll-manage.salary_number_7')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.food_review')
            @lang('app.payroll-manage.kitchen_main')
            @lang('app.payroll-manage.salary_number_8')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.support')
            @lang('app.payroll-manage.salary_number_9')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.total')
            @lang('app.payroll-manage.salary_increase')<br>
            @lang('app.payroll-manage.salary_number_10')
        </th>
        <th class="title_header_excel" colspan="3">
            @lang('app.payroll-manage.punish_from_salary')
        </th>

        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.total')
            @lang('app.payroll-manage.punish')<br>
            @lang('app.payroll-manage.salary_number_14')
        </th>
        <th class="title_header_excel" colspan="3">
            @lang('app.payroll-manage.decrease_from_salary')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.total_decrease_salary')<br>
            @lang('app.payroll-manage.salary_number_18')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.total_decrease')<br>
            @lang('app.payroll-manage.salary_number_19')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.total_salary')<br>
            @lang('app.payroll-manage.salary_number_20')
        </th>
        <th class="title_header_excel" rowspan="2">
            @lang('app.payroll-manage.reality_received')<br>
            @lang('app.payroll-manage.salary_number_21')
        </th>

    </tr>
    <tr>
        <th class="title_header_excel">
            @lang('app.payroll-manage.punish_late')
            @lang('app.payroll-manage.salary_number_11')
        </th>
        <th class="title_header_excel">
            @lang('app.payroll-manage.punish_not')
            @lang('app.payroll-manage.check_out')
            @lang('app.payroll-manage.salary_number_12')
        </th>
        <th class="title_header_excel">
            @lang('app.payroll-manage.punish_other')
            @lang('app.payroll-manage.salary_number_13')
        </th>
        <th class="title_header_excel">
            @lang('app.payroll-manage.decrease')
            @lang('app.payroll-manage.salary_number_15')
        </th>
        <th class="title_header_excel">
            @lang('app.payroll-manage.advance')
            @lang('app.payroll-manage.salary_number_16')
        </th>
        <th class="title_header_excel">
            @lang('app.payroll-manage.bill_debt')
            @lang('app.payroll-manage.salary_number_17')
        </th>
    </tr>
    <tr>
        <th class="leave_allowed"></th>
        <th class="leave_of_absence"></th>
        <th class="leave_not_allow"></th>
        <th class="kpi_point"></th>
        <th class="base_salary_after_increase"></th>
        <th class="work_day"></th>
        <th class="salary_based_on_workday"></th>
        <th class="sale_point_bonus"></th>
        <th class="bonus_booking"></th>
        <th class="bonus_kaizen"></th>
        <th class="customer_new"></th>
        <th class="customer_bonus"></th>
        <th class="other_bonus"></th>
        <th class="kitchen_staff_evaluate_food"></th>
        <th class="chef_evaluate_food"></th>
        <th class="support"></th>
        <th class="total_bonus"></th>
        <th class="excessive_late_fines"></th>
        <th class="excessive_fines_without_check_out"></th>
        <th class="other_punish"></th>
        <th class="total_punish_amount"></th>
        <th class="uniform_money"></th>
        <th class="pre_paid_amount"></th>
        <th class="debt_wrong_bill"></th>
        <th class="total_salary_reduce"></th>
        <th class="total_punish"></th>
        <th class="total_salary"></th>
        <th class="total_temporary_salary"></th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="32"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="32">
            @lang('app.payroll-manage.excel.text5')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/payroll/export.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
