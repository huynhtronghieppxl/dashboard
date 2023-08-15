async function exportExcelVatReport() {
    $('#total-value-sell-vat-report label').text($('#total-value').text());
    if (typeTimeSellVatReport !== 13) {
        $('#type-inventory-vat-report').text(timeSellVatReportV2);
    } else {
        $('#type-inventory-vat-report').text(fromDateVatReport + ' Đến ' + toDateCateVatReport);
    }
    $('#title-excel-vat-report span').text();
    $('#table-export-vat-report tbody').html('');
    if (dataExcelVatReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelVatReport.entries()) {
        $('#table-export-vat-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td style="text-align: center">${v.report_time}</td>
                <td style="text-align: center">${v.total_amount}</td>
                </tr>`)
    }
    ExportGiftFoodReportIndex()
}
function ExportGiftFoodReportIndex() {
    let element = $('#table-export-vat-report');
    let name = $('#title-excel-vat-report').text();
    exportExcelTableTemplate(element, name);
}
