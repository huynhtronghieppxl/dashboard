let totalDoneCostDebtReport, totalWaitingCostDebtReport, totalDebtCostDebtReport;
async function exportExcelCostDebtReport() {
    $('.total-done-cost-debt-report').text(totalDoneCostDebtReport);
    $('.total-waiting-cost-debt-report').text(totalWaitingCostDebtReport);
    $('.total-debt-cost-debt-report').text(totalDebtCostDebtReport);
    $('#title-excel-cost-debt-report span').text();
    $('#table-export-cost-debt-report tbody').html('');
    if (dataExcelCostDebtReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelCostDebtReport.entries()) {
        $('#table-export-cost-debt-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.addition_fee_reason_content}</td>
                <td style="text-align: center">${formatNumber(v.amount)}</td>
                <td style="text-align: center">${formatNumber(v.waiting_amount)}</td>
                <td style="text-align: center">${formatNumber(v.debt_amount)}</td>`)
    }
    exportExcelTableTemplate($('#table-export-cost-debt-report'), $('#title-excel-cost-debt-report').text())
}
