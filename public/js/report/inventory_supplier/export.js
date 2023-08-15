let totalAmountInventorySupplier;
async function exportExcelInventorySupplierReport() {
    $('.total-amount-inventory-supplier label').text(totalAmountInventorySupplier)
    $('#title-excel-inventory-supplier-report span').text();
    $('#table-export-inventory-supplier-report tbody').html('');
    $('#table-export-inventory-supplier-report .export-inventory-supplier-report-brand').text(`THƯƠNG HIỆU: ${$('.select-brand:first option:selected').text()} - CHI NHÁNH: ${$('.select-branch:first option:selected').text()}`)
    if (dataExcelInventorySupplierReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelInventorySupplierReport.entries()) {
        $('#table-export-inventory-supplier-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.restaurant_material_name}</td>
                <td style="text-align: center">${v.material_category_type_name}</td>
                <td style="text-align: center">${v.material_category_type_parent_name}</td>
                <td>${formatNumber(v.accept_quantity)}</td>
                <td>${formatNumber(v.small_accept_quantity)}</td>
                <td>${formatNumber(v.total_price_reality)}</td>`)
    }
    exportExcelTableTemplate($('#table-export-inventory-supplier-report'), $('#title-excel-inventory-supplier-report').text())
}
