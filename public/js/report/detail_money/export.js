let totalInDetailMoneyReport, totalOutDetailMoneyReport, dataExcelDetailMoneyReport;
async function exportExcelDetailMoneyReport() {
    $('#total-in-amount label').text(totalInDetailMoneyReport);
    $('#total-out-amount label').text(totalOutDetailMoneyReport);
    $('#title-excel-detail-money-report span').text();
    $('#table-export-detail-money-report tbody').html('');
    if (dataExcelDetailMoneyReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelDetailMoneyReport.entries()) {
        $('#table-export-detail-money-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td style="text-align: center;">${v.code}</td>
                <td>${v.employee_full_name}</td>
                <td style="text-align: center;">${v.create_at}</td>
                <td>${v.object_name}</td>
                <td style="text-align: center;">${v.addition_fee_reason_type_name}</td>
                <td>${formatNumber(v.amount)}</td>`)
    }
    exportExcelTableTemplate($('#table-export-detail-money-report'), $('#title-excel-detail-money-report').text())
}
