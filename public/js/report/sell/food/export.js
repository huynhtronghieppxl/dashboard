async function exportExcelFoodReport() {
    $('#total-quantity-sell-food-report label').text($('#total-quantity-card2').text());
    $('#total-original-sell-food-report label').text($('#total-original-card2').text());
    $('#total-money-sell-food-report label').text($('#total-money-card2').text());
    $('#total-profit-sell-food-report label').text($('#total-profit-card2').text());
    if (typeTimeSellFoodReport !== 13) {
        $('#type-inventory-food-report').text(timeSellFoodReportV2);
    } else {
        $('#type-inventory-food-report').text(fromDateFoodReport + ' Đến ' + toDateCateFoodReport);
    }
    $('#title-excel-food-report span').text();
    $('#table-export-food-report tbody').html('');
    if (dataExcelFoodReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelFoodReport.entries()) {
        $('#table-export-food-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td style="text-align: left">${v.food_name}</td>
                <td style="text-align: center">${formatNumber(v.quantity)}</td>
                <td style="text-align: center">${formatNumber(v.total_original_amount)}</td>
                <td style="text-align: center">${formatNumber(v.total_amount)}</td>
                <td style="text-align: center">${formatNumber(v.profit)}</td>
                <td style="text-align: center">${formatNumber(v.profit_ratio)}</td>
                </tr>`)
    }
    exportExcelTableTemplate($('#table-export-food-report'), $('#title-excel-food-report').text(),
        $('#type-inventory-food-report').text(),
        $('#total-quantity-sell-food-report label').text(),
        $('#total-original-sell-food-report label').text(),
        $('#total-money-sell-food-report label').text(),
        $('#total-profit-sell-food-report label').text())
}
