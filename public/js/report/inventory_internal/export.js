let formTabInventoryInternal, dataExcelInventoryInternalReport = [], dataExcelInventoryInternalBarReport=[];
// Kitchen
let totalInventoryInternalKitchenOpenAmount, totalInventoryInternalKitchenImportAmount,
    totalInventoryInternalKitchenExportAmount, totalInventoryInternalKitchenWastageAmount,
    totalInventoryInternalKitchenCancelAmount, totalInventoryInternalKitchenAfterAmount,
    totalInventoryInternalKitchenCheckAmount, totalInventoryInternalKitchenDiffAmount;
// Bar
let totalInventoryInternalBarOpenAmount, totalInventoryInternalBarImportAmount, totalInventoryInternalBarExportAmount,
    totalInventoryInternalBarWastageAmount, totalInventoryInternalBarCancelAmount, totalInventoryInternalBarAfterAmount,
    totalInventoryInternalBarCheckAmount, totalInventoryInternalBarDiffAmount;
async function exportExcelInventoryInternalReport() {
    await $('#tabs-form-inventory-internal li').each(function () {
        if($(this).find('a').hasClass('active')){
            formTabInventoryInternal = $(this).find('a.active').attr('data-id');
        }
    });
    let dataTable = null;
    if( formTabInventoryInternal == '1') {
        dataTable = dataExcelInventoryInternalReport;
        $('.type-report-checklist-inventory-internal').text('Kho Bếp');
        /**
         * Kitchen
         */
        $('.total-quantity-open-bar label').text(totalInventoryInternalKitchenOpenAmount);
        $('.total-quantity-import-bar label').text(totalInventoryInternalKitchenImportAmount);
        $('.total-quantity-export-bar label').text(totalInventoryInternalKitchenExportAmount);
        $('.total-quantity-cancel-bar label').text(totalInventoryInternalKitchenCancelAmount);
        $('.total-quantity-wastage-bar label').text(totalInventoryInternalKitchenWastageAmount);
        $('.total-quantity-after-bar label').text(totalInventoryInternalKitchenAfterAmount);
        $('.total-quantity-check-bar label').text(totalInventoryInternalKitchenCheckAmount);
        $('.total-quantity-diff-bar label').text(totalInventoryInternalKitchenDiffAmount);
    } else {
        dataTable = dataExcelInventoryInternalBarReport;
        $('.type-report-checklist-inventory-internal').text('Kho Bar');
        /**
         * Bar
         */
        $('.total-quantity-open-bar label').text(totalInventoryInternalBarOpenAmount);
        $('.total-quantity-import-bar label').text(totalInventoryInternalBarImportAmount);
        $('.total-quantity-export-bar label').text(totalInventoryInternalBarExportAmount);
        $('.total-quantity-cancel-bar label').text(totalInventoryInternalBarCancelAmount);
        $('.total-quantity-wastage-bar label').text(totalInventoryInternalBarWastageAmount);
        $('.total-quantity-after-bar label').text(totalInventoryInternalBarAfterAmount);
        $('.total-quantity-check-bar label').text(totalInventoryInternalBarCheckAmount);
        $('.total-quantity-diff-bar label').text(totalInventoryInternalBarDiffAmount);
    }
    $('#title-excel-inventory-internal-report span').text();
    $('#table-export-inventory-internal-report tbody').html('');
    if (dataTable?.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    $('#table-export-report-inventory-internal .export-report-checklist-inventory-internal').text(`THƯƠNG HIỆU: ${$('.select-brand:first option:selected').text()} - CHI NHÁNH: ${$('.select-branch:first option:selected').text()}`)
    $('#table-export-report-inventory-internal tbody tr').remove();
    for await(const [i, v] of dataTable.entries()) {
        $('#table-export-report-inventory-internal tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.name}<br>
                ĐV: ${v.material_unit_full_name}</td>
                <td style="text-align: center">${v.material_category_name}<br>
                <td style="text-align: center">${formatNumber((v.opening_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.receive_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.food_recipe_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.cancel_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.wastage_allow_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.system_last_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.confirm_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.difference_quantity).toFixed(0))}</td>`)
    }
    exportExcelTableTemplate($('#table-export-report-inventory-internal'),
        $('#title-excel-inventory-internal-report').text())
}
