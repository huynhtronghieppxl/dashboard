async function exportExcelCostReport() {
    $('.total-amount-cost-report label').text($('#total-amount-cost-report').text());
    $('#title-excel-cost-report span').text();
    $('#table-export-cost-report tbody').html('');
    $('#brand-excel-cost').text($('.select-brand-report').parent().find('.option-content').text());
    $('#branch-excel-cost').text($('.select-branch-report').parent().find('.option-content').text())

    getTimeBasedOnTypeReport($('#time-excel-cost'), typeActionCostReport);
    if (dataExcelCostReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelCostReport.entries()) {
        $('#table-export-cost-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.addition_fee_reason_content}</td>
                <td style="text-align: center">${formatNumber((v.amount).toFixed(0))}</td>`)
    }
    exportExcelTableTemplate($('#table-export-cost-report'), $('#title-excel-cost-report').text())
}
