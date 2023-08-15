let formTabInventory, dataExcelWarehouseInternalReport;
// Material
let totalInventoryMaterialOpenAmount, totalInventoryMaterialImportAmount, totalInventoryMaterialExportAmount,
    totalInventoryMaterialReturnAmount, totalInventoryMaterialCancelAmount, totalInventoryMaterialAfterAmount,
    totalInventoryMaterialCheckAmount, totalInventoryMaterialDiffAmount;
let totalInventoryMaterialOpenQuantity, totalInventoryMaterialImportQuantity, totalInventoryMaterialExportQuantity,
    totalInventoryMaterialReturnQuantity, totalInventoryMaterialCancelQuantity, totalInventoryMaterialAfterQuantity,
    totalInventoryMaterialCheckQuantity, totalInventoryMaterialDiffQuantity;
// Goods
let totalInventoryGoodsOpenAmount, totalInventoryGoodsImportAmount, totalInventoryGoodsExportAmount,
    totalInventoryGoodsReturnAmount, totalInventoryGoodsCancelAmount, totalInventoryGoodsAfterAmount,
    totalInventoryGoodsCheckAmount, totalInventoryGoodsDiffAmount;
let totalInventoryGoodsOpenQuantity, totalInventoryGoodsImportQuantity, totalInventoryGoodsExportQuantity,
    totalInventoryGoodsReturnQuantity, totalInventoryGoodsCancelQuantity, totalInventoryGoodsAfterQuantity,
    totalInventoryGoodsCheckQuantity, totalInventoryGoodsDiffQuantity;
// Internal
let totalInventoryInternalOpenAmount, totalInventoryInternalImportAmount, totalInventoryInternalExportAmount,
    totalInventoryInternalReturnAmount, totalInventoryInternalCancelAmount, totalInventoryInternalAfterAmount,
    totalInventoryInternalCheckAmount, totalInventoryInternalDiffAmount;
let totalInventoryInternalOpenQuantity, totalInventoryInternalImportQuantity, totalInventoryInternalExportQuantity,
    totalInventoryInternalReturnQuantity, totalInventoryInternalCancelQuantity, totalInventoryInternalAfterQuantity,
    totalInventoryInternalCheckQuantity, totalInventoryInternalDiffQuantity;
// Other
let totalInventoryOtherOpenAmount, totalInventoryOtherImportAmount, totalInventoryOtherExportAmount,
    totalInventoryOtherReturnAmount, totalInventoryOtherCancelAmount, totalInventoryOtherAfterAmount,
    totalInventoryOtherCheckAmount, totalInventoryOtherDiffAmount;
let totalInventoryOtherOpenQuantity, totalInventoryOtherImportQuantity, totalInventoryOtherExportQuantity,
    totalInventoryOtherReturnQuantity, totalInventoryOtherCancelQuantity, totalInventoryOtherAfterQuantity,
    totalInventoryOtherCheckQuantity, totalInventoryOtherDiffQuantity;
async function exportExcelInventoryReport() {
    await $('#tabs-form-inventory li').each(function () {
        if($(this).find('a').hasClass('active')){
            formTabInventory = $(this).find('a').attr('data-type');
        }
    });
    if( formTabInventory == '1') {
        /**
         * Material
         */
        $('.type-inventory-inventory-report').text('Kho nguyên liệu');
        // Amount
        $('.total-amount-open-inventory label').text(totalInventoryMaterialOpenAmount);
        $('.total-amount-import-inventory label').text(totalInventoryMaterialImportAmount);
        $('.total-amount-export-inventory label').text(totalInventoryMaterialExportAmount);
        $('.total-amount-return-inventory label').text(totalInventoryMaterialReturnAmount);
        $('.total-amount-cancel-inventory label').text(totalInventoryMaterialCancelAmount);
        $('.total-amount-after-inventory label').text(totalInventoryMaterialAfterAmount);
        $('.total-amount-check-inventory label').text(totalInventoryMaterialCheckAmount);
        $('.total-amount-diff-inventory label').text(totalInventoryMaterialDiffAmount);
        // Quantity
        $('.total-quantity-open-inventory label').text(totalInventoryMaterialOpenQuantity);
        $('.total-quantity-import-inventory label').text(totalInventoryMaterialImportQuantity);
        $('.total-quantity-export-inventory label').text(totalInventoryMaterialExportQuantity);
        $('.total-quantity-return-inventory label').text(totalInventoryMaterialReturnQuantity);
        $('.total-quantity-cancel-inventory label').text(totalInventoryMaterialCancelQuantity);
        $('.total-quantity-after-inventory label').text(totalInventoryMaterialAfterQuantity);
        $('.total-quantity-check-inventory label').text(totalInventoryMaterialCheckQuantity);
        $('.total-quantity-diff-inventory label').text(totalInventoryMaterialDiffQuantity);
    }else if (formTabInventory == '2') {
        /**
         * Goods
         */
        $('.type-inventory-inventory-report').text('Kho hàng hóa');
        // Amount
        $('.total-amount-open-inventory label').text(totalInventoryGoodsOpenAmount);
        $('.total-amount-import-inventory label').text(totalInventoryGoodsImportAmount);
        $('.total-amount-export-inventory label').text(totalInventoryGoodsExportAmount);
        $('.total-amount-return-inventory label').text(totalInventoryGoodsReturnAmount);
        $('.total-amount-cancel-inventory label').text(totalInventoryGoodsCancelAmount);
        $('.total-amount-after-inventory label').text(totalInventoryGoodsAfterAmount);
        $('.total-amount-check-inventory label').text(totalInventoryGoodsCheckAmount);
        $('.total-amount-diff-inventory label').text(totalInventoryGoodsDiffAmount);
        // Quantity
        $('.total-quantity-open-inventory label').text(totalInventoryGoodsOpenQuantity);
        $('.total-quantity-import-inventory label').text(totalInventoryGoodsImportQuantity);
        $('.total-quantity-export-inventory label').text(totalInventoryGoodsExportQuantity);
        $('.total-quantity-return-inventory label').text(totalInventoryGoodsReturnQuantity);
        $('.total-quantity-cancel-inventory label').text(totalInventoryGoodsCancelQuantity);
        $('.total-quantity-after-inventory label').text(totalInventoryGoodsAfterQuantity);
        $('.total-quantity-check-inventory label').text(totalInventoryGoodsCheckQuantity);
        $('.total-quantity-diff-inventory label').text(totalInventoryGoodsDiffQuantity);
    }else if (formTabInventory == '3') {
        /**
         * Internal
         */
        $('.type-inventory-inventory-report').text('Kho nội bộ');
        // Amount
        $('.total-amount-open-inventory label').text(totalInventoryInternalOpenAmount);
        $('.total-amount-import-inventory label').text(totalInventoryInternalImportAmount);
        $('.total-amount-export-inventory label').text(totalInventoryInternalExportAmount);
        $('.total-amount-return-inventory label').text(totalInventoryInternalReturnAmount);
        $('.total-amount-cancel-inventory label').text(totalInventoryInternalCancelAmount);
        $('.total-amount-after-inventory label').text(totalInventoryInternalAfterAmount);
        $('.total-amount-check-inventory label').text(totalInventoryInternalCheckAmount);
        $('.total-amount-diff-inventory label').text(totalInventoryInternalDiffAmount);
        // Quantity
        $('.total-quantity-open-inventory label').text(totalInventoryInternalOpenQuantity);
        $('.total-quantity-import-inventory label').text(totalInventoryInternalImportQuantity);
        $('.total-quantity-export-inventory label').text(totalInventoryInternalExportQuantity);
        $('.total-quantity-return-inventory label').text(totalInventoryInternalReturnQuantity);
        $('.total-quantity-cancel-inventory label').text(totalInventoryInternalCancelQuantity);
        $('.total-quantity-after-inventory label').text(totalInventoryInternalAfterQuantity);
        $('.total-quantity-check-inventory label').text(totalInventoryInternalCheckQuantity);
        $('.total-quantity-diff-inventory label').text(totalInventoryInternalDiffQuantity);
    }else{
        /**
         * Other
         */
        $('.type-inventory-inventory-report').text('Kho khác');
        // Amount
        $('.total-amount-open-inventory label').text(totalInventoryOtherOpenAmount);
        $('.total-amount-import-inventory label').text(totalInventoryOtherImportAmount);
        $('.total-amount-export-inventory label').text(totalInventoryOtherExportAmount);
        $('.total-amount-return-inventory label').text(totalInventoryOtherReturnAmount);
        $('.total-amount-cancel-inventory label').text(totalInventoryOtherCancelAmount);
        $('.total-amount-after-inventory label').text(totalInventoryOtherAfterAmount);
        $('.total-amount-check-inventory label').text(totalInventoryOtherCheckAmount);
        $('.total-amount-diff-inventory label').text(totalInventoryOtherDiffAmount);
        // Quantity
        $('.total-quantity-open-inventory label').text(totalInventoryOtherOpenQuantity);
        $('.total-quantity-import-inventory label').text(totalInventoryOtherImportQuantity);
        $('.total-quantity-export-inventory label').text(totalInventoryOtherExportQuantity);
        $('.total-quantity-return-inventory label').text(totalInventoryOtherReturnQuantity);
        $('.total-quantity-cancel-inventory label').text(totalInventoryOtherCancelQuantity);
        $('.total-quantity-after-inventory label').text(totalInventoryOtherAfterQuantity);
        $('.total-quantity-check-inventory label').text(totalInventoryOtherCheckQuantity);
        $('.total-quantity-diff-inventory label').text(totalInventoryOtherDiffQuantity);
    }
    $('#title-excel-inventory-report span').text();
    $('#table-export-inventory-report tbody').html('');
    if (dataExcelWarehouseInternalReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    $('#table-export-report-inventory .export-report-checklist-inventory').text(`THƯƠNG HIỆU: ${$('.select-brand:first option:selected').text()} - CHI NHÁNH: ${$('.select-branch:first option:selected').text()}`)
    $('#table-export-report-inventory tbody tr').remove();
    for await(const [i, v] of dataExcelWarehouseInternalReport.entries()) {
        $('#table-export-report-inventory tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.name}<br>
                ĐV: ${v.material_unit_full_name}</td>
                <td style="text-align: center">${v.material_category_name}<br>
                <td style="text-align: center">${formatNumber((v.opening_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.opening_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_receive_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.total_receive_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_export_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.total_export_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_return_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.total_return_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_cancel_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.total_cancel_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.system_last_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.system_last_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.confirm_last_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.confirm_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.difference_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.difference_quantity).toFixed(0))}</td>`)
    }
    exportExcelTableTemplate($('#table-export-report-inventory'),
        $('#title-excel-inventory-report').text())
}
