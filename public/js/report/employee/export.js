let totalOrderEmployeeReport, totalRevenueEmployeeReport;
async function exportExcelEmployeeReport() {
    $('.total-order-employee-report label').text(totalOrderEmployeeReport);
    $('.total-revenue-employee-report label').text(totalRevenueEmployeeReport);
    $('#title-excel-employee-report span').text();
    $('#table-export-employee-report tbody').html('');
    if (dataExcelEmployeeReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelEmployeeReport.entries()) {
        $('#table-export-employee-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.employee_name}</td>
                <td style="text-align: center">${formatNumber(v.order_count)}</td>
                <td style="text-align: center">${formatNumber(v.revenue)}</td>`)
    }
    exportExcelTableTemplate($('#table-export-employee-report'), $('#title-excel-employee-report').text())
}
