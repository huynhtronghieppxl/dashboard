async function exportExcelSellOrderReportByTime() {
    $('#table-export-sell-order-report-by-time tbody').html('');
    if (tableSellOrderReportByTime.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    $('#brand-export-sell-order-report-by-time').text(`THƯƠNG HIỆU: ${$('.select-brand option:selected').text()} - CHI NHÁNH: ${$('.select-branch option:selected').text()}`);
    for await(const [i, v] of tableSellOrderReportByTime.entries()) {
        $('#table-export-sell-order-report-by-time tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td style="text-align: left">${v.report_time}</td>
                <td style="text-align: center">${v.order}</td>
                <td style="text-align: center">${v.revenue_without_vat_amount}</td>
                <td style="text-align: center">${v.total_vat_amount}</td>
                <td style="text-align: center">${v.revenue_amount}</td>
                </tr>`)
    }
    exportExcelTableTemplate($('#table-export-sell-order-report-by-time'), $('#title-excel-sell-order-report-by-time').text())
}
