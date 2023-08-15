let totalCustomerSellOrderReport, totalVatSellOrderReport,
    totalDiscountSellOrderReport, totalBankOrderSellOrderReport,
    totalCashSellOrderReport, totalTransferOrderSellOrderReport,
    totalValueSellOrderReport;
async function exportExcelSellOrderReport() {
    $('.total-customer-order label').text(totalCustomerSellOrderReport);
    $('.total-vat label').text(totalVatSellOrderReport);
    $('.total-discount label').text(totalDiscountSellOrderReport);
    $('.total-bank label').text(totalBankOrderSellOrderReport);
    $('.total-cash label').text(totalCashSellOrderReport);
    $('.total-transfer label').text(totalTransferOrderSellOrderReport);
    $('.total-value-order label').text(totalValueSellOrderReport);
    $('#title-excel-sell-order-report span').text();
    $('#table-export-sell-order-report tbody').html('');
    if (dataExcelSellOrderReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelSellOrderReport.entries()) {
        $('#table-export-sell-order-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.employee_full_name}<br>
                BP: ${v.employee_role_name}</td>
                <td style="text-align: center">${v.table_name}</td>
                <td style="text-align: center">${formatNumber(v.table_merging_names)}</td>
                <td style="text-align: center">${formatNumber(v.move_from_table_name)}</td>
                <td style="text-align: center">${formatNumber(v.customer_slot_number)}</td>
                <td style="text-align: center">${formatNumber(v.vat_amount)}</td>
                <td style="text-align: center">${formatNumber(v.discount_amount)}</td>
                <td style="text-align: center">${formatNumber(v.bank_amount)}</td>
                <td style="text-align: center">${formatNumber(v.cash_amount)}</td>
                <td style="text-align: center">${formatNumber(v.transfer_amount)}</td>
                <td style="text-align: center">${formatNumber(v.total_amount)}</td>
                <td style="text-align: center">${v.created_at}</td>
                <td style="text-align: center">${v.used_time}</td>`)
    }
    exportExcelTableTemplate($('#table-export-sell-order-report'), $('#title-excel-sell-order-report').text())
}
