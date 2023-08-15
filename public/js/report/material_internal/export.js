async function exportExcelMaterialInternalReport() {
    await $('#tabs-form-material-internal li').each(function () {
        if($(this).find('a').hasClass('active')){
            formTab = $(this).find('a').attr('data-tab');
        }
    });
    let dataTable = null;
    if( formTab == '1') {
        $('.type-inventory-material-internal-report').text('Kho Bếp');
        dataTable = dataExcelMaterialMaterialInternalReport;
    } else {
        $('.type-inventory-material-internal-report').text('Kho Bar');
        dataTable = dataExcelBarMaterialInternalReport;
    }
    $('#title-excel-material-internal-report span').text();
    $('#table-export-material-internal-report tbody').html('');
    if (dataTable.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    $('#table-export-material-internal-report .brand-export-material-internal-report').text(`THƯƠNG HIỆU: ${$('.select-brand:first option:selected').text()} - CHI NHÁNH: ${$('.select-branch:first option:selected').text()}`)
    for await(const [i, v] of dataTable.entries()) {
        $('#table-export-material-internal-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.unit}</td>
                <td>${formatNumber(v.confirm_system_quantity)}</td>
                <td>${formatNumber(v.import_quantity)}</td>
                <td>${formatNumber(v.export_quantity)}</td>
                <td>${formatNumber(v.return_quantity)}</td>
                <td>${formatNumber(v.cancel_quantity)}</td>
                <td>${formatNumber(v.wastage_rate)}</td>
                <td>${formatNumber(v.wastage_allow_quantity)}</td>
                <td>${formatNumber(v.system_last_quantity)}</td>`)
    }
    exportExcelTableTemplate($('#table-export-material-internal-report'), $('#title-excel-material-internal-report').text())
}
