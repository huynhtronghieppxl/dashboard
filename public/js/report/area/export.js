let totalOrderCountAreaReport, totalRevenueAreaReport;
async function exportExcelAreaReport() {
    $('.total-order-area-report label').text(totalOrderCountAreaReport);
    $('.total-revenue-area-report label').text(totalRevenueAreaReport);
    $('#title-excel-area-report span').text();
    $('#table-export-area-report tbody').html('');
    if (dataExcelAreaReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelAreaReport.entries()) {
        $('#table-export-area-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td style="text-align: center">${v.area_name}</td>
                <td style="text-align: center">${formatNumber(v.order_count)}</td>
                <td style="text-align: center">${formatNumber(v.revenue)}</td>`)
    }
    exportExcelTableTemplate($('#table-export-area-report'), $('#title-excel-area-report').text())
}
