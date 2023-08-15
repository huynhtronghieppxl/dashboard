let totalQuantityProfitReport, totalOriginalProfitReport,
    totalRevenueProfitReport, totalProfitProfitReport;
async function exportExcelProfitReport() {
    $('.total-quantity label').text(totalQuantityProfitReport);
    $('.total-original label').text(totalOriginalProfitReport);
    $('.total-revenue label').text(totalRevenueProfitReport);
    $('.total-profit label').text(totalProfitProfitReport);
    $('#title-excel-profit-report span').text();
    $('#table-export-profit-report tbody').html('');
    if (dataExcelProfitReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelProfitReport.entries()) {
        $('#table-export-profit-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.food_name}<br>
                ĐV: ${v.unit_name}</td>
                <td style="text-align: center">${v.type}</td>
                <td style="text-align: center">${formatNumber(v.quantity)}</td>
                <td style="text-align: center">${formatNumber(v.total_original_amount)}</td>
                <td style="text-align: center">${formatNumber(v.total_amount)}</td>
                <td style="text-align: center">${formatNumber(v.profit)}</td>
                <td style="text-align: center">${formatNumber((v.profit_ratio))}</td>`)
    }
    exportExcelTableTemplate($('#table-export-profit-report'), $('#title-excel-profit-report').text())
}
