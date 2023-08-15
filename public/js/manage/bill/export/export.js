async function exportBillManage() {
    $('#amount-bill-detail-export').text(amountBillManage);
    $('#total-vat-detail-export').text(VATBillManage);
    $('#total-discount-detail-export').text(discountBillManage);
    $('#total-point-detail-export').text(pointBillManage);
    $('#total-amount-detail-export').text(totalAmountBillManage);
    $('#total-amount-original-detail-export').text(originalPriceBillManage);
    $('#total-amount-accumulated-detail-export').text(accumulatePointBillManage);
    $('#total-slot-customer-detail-export').text(totalSlotCustomerBillManage);
    $('#total-average-profit-detail-export').text(averageProfitBillManage);
    $('#title-excel-bill-manage span').text();
    $('#brand-excel-bill-manage').text($('.select-brand').parent().find('.option-content').text());
    $('#branch-excel-bill-manage').text($('.select-branch').parent().find('.option-content').text())
    $('#table-export-bill-manage tbody').html('');
    if (dataListExcelBillManage.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataListExcelBillManage.entries()) {
        $('#table-export-bill-manage tbody').append(`<tr>
            <td style="text-align: center">${i + 1}</td>
            <td style="text-align: center">${v.id}</td>
            <td style="text-align: center">${v.table_name}</td>
            <td style="text-align: center">${v.employee.name}</td>
            <td style="text-align: center">${v.customer.name}</td>
            <td style="text-align: center">${formatNumber(v.amount)}</td>
            <td style="text-align: center">${formatNumber(v.vat_amount)}</td>
            <td style="text-align: center">${formatNumber(v.discount_amount)}</td>
            <td style="text-align: center">${formatNumber(v.membership_total_point_used_amount)}</td>
            <td style="text-align: center">${formatNumber(v.using_slot)}</td>
            <td style="text-align: center">${formatNumber(v.total_amount)}</td>
            <td style="text-align: center">${formatNumber(v.membership_point_added)}</td>
            <td style="text-align: center">${formatNumber(v.original_price)}</td>
            <td style="text-align: center">${formatNumber(v.rate_profit)}</td>
            <td style="text-align: center">${v.payment_date}</td>
            <td style="text-align: center">${v.order_status_name}</td>
            </tr>`);
    }
    ExportIndex()
}

function ExportIndex() {
    let element = $('#table-export-bill-manage');
    let name = $('#title-excel-bill-manage').text();
    exportExcelTableTemplate(element, name);
}
