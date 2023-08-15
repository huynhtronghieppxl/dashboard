async function exportExcelRevenueReport() {
    $('#title-excel-revenue-report span').text();
    $('#table-export-revenue-report tbody').html('');
    if (dataExcelDebtReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelDebtReport.entries()) {
        $('#table-export-revenue-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.addition_fee_reason_content}</td>
                <td style="text-align: center">${formatNumber((v.amount).toFixed(0))}</td>`)
    }
    exportExcelTableTemplate($('#table-export-revenue-report'), $('#title-excel-revenue-report').text())
}
