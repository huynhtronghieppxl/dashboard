let tableDataDetailDeductionsPayrollManage,
    tableDataDetailSalesScorePayrollManage,
    tableDataDetailTimeKeepHistoryPayrollManage,
    tableDataDetailDebtPayrollManage;

$(function (){
    $(document).on('input paste','#table-payroll-manage-detail-tab1_filter', function (){
        $('#total-record-punish-payroll-manage').text(tableDataDetailDeductionsPayrollManage.rows({'search':'applied'}).count())

        let totalTableDetailDeductionsPayrollManage = searchTableUpdateTotal1(tableDataDetailDeductionsPayrollManage);

        $('#total-payroll-manage-detail-tab1').text(formatNumber(totalTableDetailDeductionsPayrollManage));
    })

    $(document).on('input paste keyup','#table-payroll-manage-detail-tab2_filter', function (){
        $('#total-record-point-payroll-manage').text(tableDataDetailSalesScorePayrollManage.rows({'search':'applied'}).count())
        let totalTableSalePoint = searchTableUpdateTotalTab3(tableDataDetailSalesScorePayrollManage)

        $('#amount-payroll-manage-detail-tab2').text(formatNumber(totalTableSalePoint[0]))
        $('#rank-payroll-manage-detail-tab2').text(formatNumber(totalTableSalePoint[1]))
        $('#total-payroll-manage-detail-tab2').text(formatNumber(totalTableSalePoint[2]))
    })
    $(document).on('input paste keyup','#table-payroll-manage-detail-tab3_filter', function (){
        $('#total-record-check-in-payroll-manage').text(tableDataDetailTimeKeepHistoryPayrollManage.rows({'search':'applied'}).count())
        let totalTableTimeKeepHistory = searchTotalMinuteLate(tableDataDetailTimeKeepHistoryPayrollManage)
        $('#total-payroll-manage-detail-tab3').text(totalTableTimeKeepHistory)
    })

    $(document).on('input paste keyup','#table-payroll-manage-detail-tab4_filter', function (){
        $('#total-record-debit-payroll-manage').text(tableDataDetailDebtPayrollManage.rows({'search':'applied'}).count())
    })
    $(document).on('click', '#employee_name', function (){
        openModalInfoEmployeeManage($(this).attr('data-id'));
    })
})

function detailPayroll(id, idx) {
    $('#modal-payroll').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC',function (){
        closeModalDetail();
    })
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetail();
        });
    });
    $('#modal-detail-employee-bonus-punish').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailEmployeeManage();
        });
    });
    let index = idx.parentNode.parentNode.parentNode.rowIndex;
    let reason = $('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(1) img').data('reason'),
        status = $('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(1) img').data('status')
    $('.date-detail').text($('#time-payroll-manage').val());
    $('#employee_name').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(1) p').text());
    $('#employee_name').attr('data-id', $('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(1) img').data('value'))
    $('#id-detail-payroll-manage').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(1)').find('input.id-employee').val());
    $('#employee_department').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(1) .department-inline-name-data-table').text());
    $('#employee_kpi').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(6)').text());
    $('#employee_base_salary').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(7)').text());
    $('#employee_reality_salary').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(30)').text());
    $('#employee_diligence').html('---');
    $('#employee_support').text($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(18)').text());
    $('#employee_food_bonus').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(16)').text());
    $('#employee_figure_bonus').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(10)').text());
    $('#employee_other_bonus').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(15)').text());
    $('#employee_punish').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(23)').text());
    $('#employee_uniform').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(24)').text());
    $('#employee_in_debt').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(26)').text());
    $('#employee_bonus').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(25)').text());
    $('#employee_late').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(20)').text());
    $('#employee_no_check_out').html($('table#table-data-payroll tbody tr').eq(index - 3).find('td:eq(21)').text());
    status == 7 ? $('#cancel_reason_salary_div').removeClass('d-none') : $('#cancel_reason_salary_div').addClass('d-none')
    $('#cancel_reason_salary').text(reason === '' ? '---' : reason)
    loadDataDetail(id);
}

async function loadDataDetail(id) {
    let time = $('#time-payroll-manage').val(),
        method = 'get',
        branch = $('.select-branch').val(),
        brand = $('.select-brand').val(),
        url = 'payroll-manage.detail',
        params = {
            employee_id: id,
            time: time,
            branch: branch,
            brand: brand,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#boxlist1-tab0-payroll-manage-detail'),
        $('#boxlist2-tab0-payroll-manage-detail'),
        $('#boxlist3-tab0-payroll-manage-detail'),
        $('#table-payroll-manage-detail-tab1'),
        $('#table-payroll-manage-detail-tab2'),
        $('#table-payroll-manage-detail-tab3'),
        $('#table-payroll-manage-detail-tab4'),
    ]);
    dataTableDetailPayrollManage(res);
    dataTotalDetailPayrollManage(res.data[4]);
}

async function dataTableDetailPayrollManage(data) {
    let id_tab1 = $('#table-payroll-manage-detail-tab1'),
        id_tab2 = $('#table-payroll-manage-detail-tab2'),
        id_tab3 = $('#table-payroll-manage-detail-tab3'),
        id_tab4 = $('#table-payroll-manage-detail-tab4'),
        column_tab1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'time', name: 'time', class: 'text-center'},
            {data: 'type_name', name: 'type_name', class: 'text-center'},
            {data: 'amount', name: 'amount', class: 'text-center', width: '20%'},
            {data: 'note', name: 'note', class: 'text-center'},
            {data: 'keysearch', className: 'd-none text-center'},
        ],
        column_tab2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'order_id', name: 'order_id', class: 'text-center'},
            {data: 'rank_name', name: 'rank_name', class: 'text-center'},
            {data: 'amount', name: 'amount', class: 'text-center', width: '20%'},
            {data: 'rank_amount', name: 'rank_amount', class: 'text-center', width: '20%'},
            {data: 'point', name: 'point', class: 'text-center', width: '20%'},
            {data: 'time', name: 'time', class: 'text-center'},
            {data: 'keysearch', className: 'd-none text-center'},
        ],
        column_tab3 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'date', name: 'date', class: 'text-center'},
            {data: 'branch_working_session_name', name: 'branch_working_session_name', class: 'text-center'},
            {data: 'branch_working_session', name: 'branch_working_session', class: 'text-center'},
            {data: 'checkin_time', name: 'checkin_time', class: 'text-center'},
            {data: 'checkout_time', name: 'checkout_time', class: 'text-center'},
            {data: 'late_minutes', name: 'late_minutes', class: 'text-center'},
            {data: 'keysearch', className: 'd-none text-center'},
        ],
        column_tab4 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'order_id', name: 'order_id', class: 'text-center'},
            {data: 'table_name', name: 'table_name', class: 'text-center'},
            {data: 'debt_amount', name: 'debt_amount', class: 'text-center', width: '20%'},
            {data: 'debt_time', name: 'debt_time', class: 'text-center'},
            {data: 'keysearch', className: 'd-none text-center'},
        ],
        option = [],
        scrollY = '40vh',
        fixed_left = 2,
        fixed_right = 0;
        tableDataDetailDeductionsPayrollManage = await DatatableTemplateNew(id_tab1, data.data[0].original.data, column_tab1, scrollY, fixed_left, fixed_right, option);
        tableDataDetailSalesScorePayrollManage = await DatatableTemplateNew(id_tab2, data.data[1].original.data, column_tab2, scrollY, fixed_left, fixed_right, option);
        tableDataDetailTimeKeepHistoryPayrollManage = await DatatableTemplateNew(id_tab3, data.data[2].original.data, column_tab3, scrollY, fixed_left, fixed_right, option);
        tableDataDetailDebtPayrollManage = await DatatableTemplateNew(id_tab4, data.data[3].original.data, column_tab4, scrollY, fixed_left, fixed_right, option);
}

function searchTotalMinuteLate(datatable){
    let totalMinute = 0;
    datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        totalMinute += removeformatNumber(row.find('td:eq(6)').text())
    })
    return totalMinute;
}

function searchTableUpdateTotal1(datatable){
    let total = 0;
    datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node());
        total += removeformatNumber(row.find('td:eq(3)').text())
    })
    return Math.abs(total);
}

function searchTableUpdateTotalTab3(datatable){
    let totalAmount = 0, totalRank = 0, totalPoint = 0;
    datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find('td:eq(3)').text())
        totalRank += removeformatNumber(row.find('td:eq(4)').text())
        totalPoint += removeformatNumber(row.find('td:eq(5)').text())
    })
    return [totalAmount, totalRank, totalPoint];
}

function dataTotalDetailPayrollManage(data) {
    $('#total-record-punish-payroll-manage').text(data.total_record_punish);
    $('#total-record-point-payroll-manage').text(data.total_record_point);
    $('#total-record-check-in-payroll-manage').text(data.total_record_check_in);
    $('#total-record-debit-payroll-manage').text(data.total_record_debit);
    $('#total-payroll-manage-detail-tab1').text(data.total_punish);
    $('#amount-payroll-manage-detail-tab2').text(data.total_amount);
    $('#rank-payroll-manage-detail-tab2').text(data.total_rank);
    $('#total-payroll-manage-detail-tab2').text(data.total_point);
    $('#total-payroll-manage-detail-tab3').text(data.total_check_in);
    $('#total-payroll-manage-detail-tab4').text(data.total_debit);
}

function openModalDetailEmployeeF() {
    let id = $('#id-detail-payroll-manage').text();
    openModalInfoEmployeeManage(id);
}

function closeModalDetail() {
    $('#modal-payroll').modal('hide');
    shortcut.remove('ESC');
    tableDataDetailDeductionsPayrollManage.clear().draw(false);
    tableDataDetailSalesScorePayrollManage.clear().draw(false);
    tableDataDetailTimeKeepHistoryPayrollManage.clear().draw(false);
    tableDataDetailDebtPayrollManage.clear().draw(false);
    reloadModalDetailEmployeeF()
}

function reloadModalDetailEmployeeF(){
    $('.date-detail').text('');
    $('#employee_name').html('---');
    $('#employee_department').html('---');
    $('#id-detail-payroll-manage').html('');
    $('#employee_kpi').html('');
    $('#employee_base_salary').html('');
    $('#employee_reality_salary').html('');
    $('#employee_diligence').html();
    $('#employee_support').text('');
    $('#employee_food_bonus').html('');
    $('#employee_figure_bonus').html('');
    $('#employee_other_bonus').html('');
    $('#employee_punish').html('');
    $('#employee_uniform').html('');
    $('#employee_in_debt').html('');
    $('#employee_bonus').html('');
    $('#employee_late').html('');
    $('#employee_no_check_out').html('');

}
