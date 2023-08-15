let totalOriginalAmountTakeAwayReport, totalAmountTakeAwayReport,
    totalProfitTakeAwayReport, totalQuantityTakeAwayReport;
async function exportExcelTakeAwayReport() {
    $('#total-quantity-sell-take-away-report label').text(totalQuantityTakeAwayReport);
    $('#total-original-sell-take-away-report label').text(totalOriginalAmountTakeAwayReport);
    $('#total-money-sell-take-away-report label').text(totalAmountTakeAwayReport);
    $('#total-profit-sell-take-away-report label').text(totalProfitTakeAwayReport);
    $('#title-excel-take-away-report span').text();
    $('#table-export-take-away-report tbody').html('');
    if (dataExcelTakeAwayReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelTakeAwayReport.entries()) {
        $('#table-export-take-away-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td style="text-align: left">${v.food_name}</td>
                <td style="text-align: center">${formatNumber(v.quantity)}</td>
                <td style="text-align: center">${v.unit_name}</td>
                <td style="text-align: center">${formatNumber(v.total_original_amount)}</td>
                <td style="text-align: center">${formatNumber(v.total_amount)}</td>
                <td style="text-align: center">${formatNumber(v.profit)}</td>
                <td style="text-align: center">${formatNumber(v.profit_ratio)}</td>`)
    }
    exportExcelTableTemplate($('#table-export-take-away-report'), $('#title-excel-take-away-report').text(),
        $('#total-quantity-sell-take-away-report label').text(),
        $('#total-original-sell-take-away-report label').text(),
        $('#total-money-sell-take-away-report label').text(),
        $('#total-profit-sell-take-away-report label').text())
}
