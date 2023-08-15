async function exportExcelPayrollManage() {
    $('.leave_allowed').text($('#leave_allowed').text())
    $('.leave_of_absence').text($('#leave_of_absence').text())
    $('.leave_not_allow').text($('#leave_not_allow').text())
    $('.kpi_point').text($('#kpi_point').text())
    $('.base_salary_after_increase').text($('#base_salary_after_increase').text())
    $('.work_day').text($('#work_day').text())
    $('.salary_based_on_workday').text($('#salary_based_on_workday').text())
    $('.sale_point_bonus').text($('#sale_point_bonus').text())
    $('.bonus_booking').text($('#bonus_booking').text())
    $('.bonus_kaizen').text($('#bonus_kaizen').text())
    $('.customer_new').text($('#customer_new').text())
    $('.customer_bonus').text($('#customer_bonus').text())
    $('.other_bonus').text($('#other_bonus').text())
    $('.kitchen_staff_evaluate_food').text($('#kitchen_staff_evaluate_food').text())
    $('.chef_evaluate_food').text($('#chef_evaluate_food').text())
    $('.support').text($('#support').text())
    $('.total_bonus').text($('#total_bonus').text())
    $('.excessive_late_fines').text($('#excessive_late_fines').text())
    $('.excessive_fines_without_check_out').text($('#excessive_fines_without_check_out').text())
    $('.other_punish').text($('#other_punish').text())
    $('.total_punish_amount').text($('#total_punish_amount').text())
    $('.uniform_money').text($('#uniform_money').text())
    $('.pre_paid_amount').text($('#pre_paid_amount').text())
    $('.debt_wrong_bill').text($('#debt_wrong_bill').text())
    $('.total_salary_reduce').text($('#total_salary_reduce').text())
    $('.total_punish').text($('#total_punish').text())
    $('.total_salary').text($('#total_salary').text())
    $('.total_temporary_salary').text($('#total_temporary_salary').text())
    $('#title-excel-payroll-manage span').text($('#time-payroll-manage').val());
    $('#brand-excel-salary').text($('.select-brand').parent().find('.option-content').text());
    $('#branch-excel-salary').text($('.select-branch').parent().find('.option-content').text())
    $('#table-export-payroll-manage tbody').html('');
    if (dataExcelPayrollManage.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelPayrollManage.entries()) {
        $('#table-export-payroll-manage tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td style="text-align: center">${v.employee.name}</td>
                <td style="text-align: center">${v.employee.role_name}</td>
                <td style="text-align: center">${v.branch_working_sesion_time}</td>
                <td style="text-align: center">${v.total_leave_day_with_salary}</td>
                <td style="text-align: center">${v.total_leave_day_without_salary}</td>
                <td style="text-align: center">${v.total_not_checkin_day}</td>
                <td style="text-align: center">${v.kpi_score}</td>
                <td style="text-align: center">${formatNumber(v.basic_salary_in_term)}</td>
                <td style="text-align: center">${v.total_working_day}</td>
                <td style="text-align: center">${formatNumber(v.salary_by_working_day)}</td>
                <td style="text-align: center">${formatNumber(v.target_point_bonus_salary_in_branch)}</td>
                <td style="text-align: center">${formatNumber(v.bonus_booking)}</td>
                <td style="text-align: center">${formatNumber(v.bonus_kaizen)}</td>
                <td style="text-align: center">${formatNumber(v.total_customer_invited)}</td>
                <td style="text-align: center">${formatNumber(v.customer_invited_bonus_amount)}</td>
                <td style="text-align: center">${formatNumber(v.other_bonus)}</td>
                <td style="text-align: center">${v.chef_bonus_amount}</td>
                <td style="text-align: center">${v.master_chef_bonus_amount}</td>
                <td style="text-align: center">${formatNumber(v.bonus_support_overtime_amount)}</td>
                <td style="text-align: center">${formatNumber(v.total_bonus)}</td>
                <td style="text-align: center">${formatNumber(v.punish_late_minute_amount)}</td>
                <td style="text-align: center">${formatNumber(v.punish_not_checkout_amount)}</td>
                <td style="text-align: center">${formatNumber(v.other_punish)}</td>
                <td style="text-align: center">${formatNumber(v.total_punish_amount)}</td>

                <td style="text-align: center">${formatNumber(v.uniform_amount)}</td>
                <td style="text-align: center">${formatNumber(v.pre_paid_amount)}</td>
                <td style="text-align: center">${formatNumber(v.debt_amount)}</td>

                <td style="text-align: center">${formatNumber(v.total_salary_reduce)}</td>
                <td style="text-align: center">${formatNumber(v.total_punish)}</td>
                <td style="text-align: center">${formatNumber(v.total_temporary_salary)}</td>
                <td style="text-align: center">${formatNumber(v.total_salary)}</td>

            </tr>`);
    }
    exportExcelTableTemplate($('#table-export-payroll-manage'), $('#title-excel-payroll-manage').text())
}
