let formTab;
let totalMaterialBeforeAmount, totalMaterialImportBranchAmount, totalMaterialSupplierAmount, totalMaterialKitchenReturnAmount,
    totalMaterialBarReturnAmount, totalMaterialExportBranchAmount, totalMaterialKitchenAmount, totalMaterialBarAmount,
    totalMaterialEmployeeAmount, totalMaterialInnerAmount, totalMaterialOtherAmount, totalMaterialReturnAmount,
    totalMaterialCancelAmount, totalMaterialWastageAllowAmount, totalMaterialAfterAmount;

let totalGoodsBeforeAmount, totalGoodsImportBranchAmount, totalGoodsSupplierAmount, totalGoodsKitchenReturnAmount,
    totalGoodsBarReturnAmount, totalGoodsExportBranchAmount, totalGoodsKitchenAmount, totalGoodsBarAmount,
    totalGoodsEmployeeAmount, totalGoodsInnerAmount, totalGoodsOtherAmount, totalGoodsReturnAmount,
    totalGoodsCancelAmount, totalGoodsWastageAllowAmount, totalGoodsAfterAmount;

let totalInternalBeforeAmount, totalInternalImportBranchAmount, totalInternalSupplierAmount, totalInternalKitchenReturnAmount,
    totalInternalBarReturnAmount, totalInternalExportBranchAmount, totalInternalKitchenAmount, totalInternalBarAmount,
    totalInternalEmployeeAmount, totalInternalInnerAmount, totalInternalOtherAmount, totalInternalReturnAmount,
    totalInternalCancelAmount, totalInternalWastageAllowAmount, totalInternalAfterAmount;

let totalOtherBeforeAmount, totalOtherImportBranchAmount, totalOtherSupplierAmount, totalOtherKitchenReturnAmount,
    totalOtherBarReturnAmount, totalOtherExportBranchAmount, totalOtherKitchenAmount, totalOtherBarAmount,
    totalOtherEmployeeAmount, totalOtherInnerAmount, totalOtherOtherAmount, totalOtherReturnAmount,
    totalOtherCancelAmount, totalOtherWastageAllowAmount, totalOtherAfterAmount;
async function exportExcelMaterialReport() {
    await $('#tabs-form-material li').each(function () {
        if($(this).find('a').hasClass('active')){
            formTab = $(this).find('a').attr('data-tab');
        }
    });
    let dataTable = null;
    if( formTab == '1') {
        dataTable = dataExcelWarehouseMaterialReport;
        /**
         * Material
         */
        $('.type-inventory-material-report').text('Kho nguyên liệu');
        $('.total-amount-before-material label').text(totalMaterialBeforeAmount);
        $('.total-amount-import-branch-material label').text(totalMaterialImportBranchAmount);
        $('.total-amount-import-supplier-material label').text(totalMaterialSupplierAmount);
        $('.total-amount-export-branch-material label').text(totalMaterialExportBranchAmount);
        $('.total-amount-export-kitchen-material label').text(totalMaterialKitchenAmount);
        $('.total-amount-export-bar-material label').text(totalMaterialBarAmount);
        $('.total-amount-export-employee-material label').text(totalMaterialEmployeeAmount);
        $('.total-amount-export-inner-material label').text(totalMaterialInnerAmount);
        $('.total-amount-cancel-material label').text(totalMaterialCancelAmount);
        $('.total-amount-after-material label').text(totalMaterialAfterAmount);
        $('.total-amount-import-kitchen-material label').text(totalMaterialKitchenReturnAmount);
        $('.total-amount-import-bar-material label').text(totalMaterialBarReturnAmount);
    }else if (formTab == '2') {
        dataTable = dataExcelWarehouseReport;
        /**
         * Goods
         */
        $('.type-inventory-material-report').text('Kho hàng hóa');
        $('.total-amount-before-material label').text(totalGoodsBeforeAmount);
        $('.total-amount-import-branch-material label').text(totalGoodsImportBranchAmount);
        $('.total-amount-import-supplier-material label').text(totalGoodsSupplierAmount);
        $('.total-amount-export-branch-material label').text(totalGoodsExportBranchAmount);
        $('.total-amount-export-kitchen-material label').text(totalGoodsKitchenAmount);
        $('.total-amount-export-bar-material label').text(totalGoodsBarAmount);
        $('.total-amount-export-employee-material label').text(totalGoodsEmployeeAmount);
        $('.total-amount-export-inner-material label').text(totalGoodsInnerAmount);
        $('.total-amount-cancel-material label').text(totalGoodsCancelAmount);
        $('.total-amount-after-material label').text(totalGoodsAfterAmount);
        $('.total-amount-import-kitchen-material label').text(totalGoodsKitchenReturnAmount);
        $('.total-amount-import-bar-material label').text(totalGoodsBarReturnAmount);
    }else if (formTab == '3') {
        dataTable = dataExcelInternalWarehouseReport;
        /**
         * Internal
         */
        $('.type-inventory-material-report').text('Kho nội bộ');
        $('.total-amount-before-material label').text(totalInternalBeforeAmount);
        $('.total-amount-import-branch-material label').text(totalInternalImportBranchAmount);
        $('.total-amount-import-supplier-material label').text(totalInternalSupplierAmount);
        $('.total-amount-export-branch-material label').text(totalInternalKitchenReturnAmount);
        $('.total-amount-export-kitchen-material label').text(totalInternalBarReturnAmount);
        $('.total-amount-export-bar-material label').text(totalInternalExportBranchAmount);
        $('.total-amount-export-employee-material label').text(totalInternalKitchenAmount);
        $('.total-amount-export-inner-material label').text(totalInternalBarAmount);
        $('.total-amount-cancel-material label').text(totalInternalCancelAmount);
        $('.total-amount-after-material label').text(totalInternalAfterAmount);
        $('.total-amount-import-kitchen-material label').text(totalInternalOtherAmount);
        $('.total-amount-import-bar-material label').text(totalInternalReturnAmount);
    }else{
        dataTable = dataExcelOtherWarehouseReport;
        /**
         * Other
         */
        $('.type-inventory-material-report').text('Kho khác');
        $('.total-amount-before-material label').text(totalOtherBeforeAmount);
        $('.total-amount-import-branch-material label').text(totalOtherImportBranchAmount);
        $('.total-amount-import-supplier-material label').text(totalOtherSupplierAmount);
        $('.total-amount-export-branch-material label').text(totalOtherExportBranchAmount);
        $('.total-amount-export-kitchen-material label').text(totalOtherKitchenAmount);
        $('.total-amount-export-bar-material label').text(totalOtherBarAmount);
        $('.total-amount-export-employee-material label').text(totalOtherEmployeeAmount);
        $('.total-amount-export-inner-material label').text(totalOtherInnerAmount);
        $('.total-amount-cancel-material label').text(totalOtherCancelAmount);
        $('.total-amount-after-material label').text(totalOtherAfterAmount);
        $('.total-amount-import-kitchen-material label').text(totalOtherKitchenReturnAmount);
        $('.total-amount-import-bar-material label').text(totalOtherBarReturnAmount);
    }
    $('#title-excel-material-report span').text();
    $('#table-export-material-report tbody').html('');
    if (dataTable.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    $('#table-export-report-material .brand-export-report-material').text(`THƯƠNG HIỆU: ${$('.select-brand:first option:selected').text()} - CHI NHÁNH: ${$('.select-branch:first option:selected').text()}`)
    $('#table-export-report-material tbody tr').remove();
    for await(const [i, v] of dataTable.entries()) {
            $('#table-export-report-material tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.name}<br>
                ĐV: ${v.material_unit_specification_exchange_name}</td>
                <td style="text-align: center">${formatNumber((v.total_opening_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.opening_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_receive_from_branch_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.receive_from_branch_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_receive_from_supplier_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.receive_from_supplier_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_export_outer_branch_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.export_outer_branch_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_export_kitchen_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.export_kitchen_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_export_bar_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.export_bar_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_export_employee_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.export_employee_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_export_inner_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.export_inner_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_cancel_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.cancel_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_system_last_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.system_last_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_receive_from_kitchen_return_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.receive_from_kitchen_return_quantity).toFixed(0))}</td>
                <td style="text-align: center">${formatNumber((v.total_receive_from_bar_return_amount).toFixed(0))}<br>
                <em>SL: </em>${formatNumber((v.receive_from_bar_return_quantity).toFixed(0))}</td>`)
        }
    exportExcelTableTemplate($('#table-export-report-material'),
        $('#title-excel-material-report').text())
}
