async function exportModalDetailBillManage() {
    $('#table-export-detail-bill-manage tbody tr').remove();
    await dataTableExportDetailBillManageFood.rows().every(function (index, element) {
        let x = $(this.node());
        if(x.find('td:eq(8)').find('.status-new').data('status') === 3 || x.find('td:eq(8)').find('.status-new').data('status') === 4) return false;
        $('#table-export-detail-bill-manage tbody').append('<tr>\n' +
            '<td>' + x.find('td:eq(1)').text() + '</td>' +
            '<td style="text-align: center" class="font-weight-bold">' + x.find('td:eq(4)').text() + '</td>' +
            '<td class="text-center font-weight-bold">' + x.find('td:eq(5)').text() + '</td>' +
            '<td class="text-center font-weight-bold">' + x.find('td:eq(6)').text() + '</td>' +
            '</tr>');
    });

    $('#money-export-detail-bill-manage').text($('#money-detail-bill-manage').text());
    $('#discount-export-detail-bill-manage').text($('#discount-detail-bill-manage').text());
    $('#vat-export-detail-bill-manage').text($('#vat-detail-bill-manage').text());

    checkValue($('#recharge-point-detail-bill-manage'), $('#point-export-detail-bill-manage'))
    checkValue($('#accumulated-point-detail-bill-manage'), $('#point-accumulate-export-detail-bill-manage'))
    checkValue($('#discount-point-detail-bill-manage'), $('#promotion-point-export-detail-bill-manage'))
    checkValue($('#value-point-detail-bill-manage'), $('#alo-point-export-detail-bill-manage'))

    $('#total-export-detail-bill-manage').text($('#total-point-payment-detail-bill-manage').text());
    $('#address-export-detail-bill-manage').text($('#branch-address-detail-bill-manage').text());
    $('#table-using-export-detail-bill-manage').text($('#table-detail-bill-manage').text() + ' - ' + $('#code-detail-bill-manage').text());
    $('#customer-export-detail-bill-manage').text($('#customer-detail-bill-manage').text());
    $('#cashier-export-detail-bill-manage').text($('#cashier-detail-bill-manage').text());
    $('#employee-export-detail-bill-manage').text($('#employee-detail-bill-manage').text());
    $('#date-export-detail-bill-manage').text($('#in-detail-bill-manage').text() + ' - ' + $('#out-detail-bill-manage').text());
    $('#phone-export-detail-bill-manage label').text('(+84)' + $('#branch-phone-detail-bill-manage').text());
    $('#brand-export-detail-bill-manage').text($('.select-brand').parent().find('.option-content').text());
    $('#export-branch-detail-bill-manage').text($('.select-branch').parent().find('.option-content').text())
    ExportDetail();
    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalDetailBillManage();
    });
}
// check nếu điểm = 0 thì xoá các hàng đó ra khỏi file excel
function checkValue(value, display) {
    let values = value.text()
    let point = parseInt(values.constructor === String ? values.split('(')[0] : values.match(/\d+/)[0]);

    if (point === 0) {
        display.closest('tr').remove();
    } else {
        display.text(value.text()).show();
    }
}

function ExportDetail() {
    let element = $('#table-export-detail-bill-manage');
    let name = 'Đơn hàng' + ' ' + $('#code-detail-bill-manage').text();
    exportExcelTableTemplate(element, name);
}
