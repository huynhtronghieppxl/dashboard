let totalOriginalAmountCategoryReport, totalAmountCategoryReport, totalProfitCategoryReport;
async function exportExcelCategoryReport() {
    $('#total-original-sell-category-report label').text(totalOriginalAmountCategoryReport);
    $('#total-money-sell-category-report label').text(totalAmountCategoryReport);
    $('#total-profit-sell-category-report label').text(totalProfitCategoryReport);
    $('#title-excel-category-report span').text();
    $('#table-export-category-report tbody').html('');
    if (dataExcelCategoryReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    $('#brand-export-category-report').text(`THƯƠNG HIỆU: ${$('.select-brand option:selected').text()} - CHI NHÁNH: ${$('.select-branch option:selected').text()}`);
    for await(const [i, v] of dataExcelCategoryReport.entries()) {
        $('#table-export-category-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td style="text-align: left">${v.category_name}</td>
                <td>${formatNumber(v.total_original_amount)}</td>
                <td>${formatNumber(v.total_amount)}</td>
                <td>${formatNumber(v.profit)}</td>
                <td style="text-align: center">${formatNumber(v.profit_ratio)}</td>`)
    }
    exportExcelTableTemplate($('#table-export-category-report'), $('#title-excel-category-report').text(),
        $('#total-original-sell-category-report label').text(),
        $('#total-money-sell-category-report label').text(),
        $('#total-profit-sell-category-report label').text(),)
}
