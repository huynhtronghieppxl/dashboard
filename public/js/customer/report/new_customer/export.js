async function exportExcelNewCustomerReport() {
    $('#title-excel-new-customer-report span').text();
    $('#table-export-new-customer-report tbody').html('');
    if (dataExcelNewCustomerReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelNewCustomerReport.entries()) {
        $('#table-export-new-customer-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td style="text-align: left">${v.name}</td>
                <td style="text-align: center">${v.gender === 1 ? 'Nam' : 'Nữ'}</td>
                <td style="text-align: center">${(v.register_at).slice(0, 10)}</td>
                <td style="text-align: center">${v.card_type}</td>
                <td style="text-align: center">${formatNumber(v.used_accumulate_point)}</td>`)
    }
    exportExcelTableTemplate($('#table-export-new-customer-report'), $('#title-excel-new-customer-report').text())
}
