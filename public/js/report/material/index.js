let dataTableWarehouseMaterial = null, dataTableWarehouse = null, dataTableInternalWarehouse = null, dataTableOtherWarehouse = null,
    typeTabMaterial = 1, fromMaterial = $('.from-date-material-report').val(), toMaterial = $('.to-date-material-report').val();
let dataExcelWarehouseMaterialReport, dataExcelWarehouseReport, dataExcelInternalWarehouseReport, dataExcelOtherWarehouseReport;
$(async function () {
    if (getCookieShared('material-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('material-report-user-id-' + idSession));
        typeTabMaterial = dataCookie.tab
        fromMaterial = dataCookie.from
        toMaterial = dataCookie.to
        $('.from-date-material-report').val(fromMaterial)
        $('.to-date-material-report').val(toMaterial)
    }

    dateTimePickerFromToDateTemplate2($('.from-date-material-report'), $('.to-date-material-report'))
    $('.search-btn-material-report').on('click', function () {
        fromMaterial = $('.from-date-material-report').val();
        toMaterial = $('.to-date-material-report').val();
        updateCookieMaterial()
        validateDateTemplate($('.from-date-material-report'), $('.to-date-material-report'), loadData);
    });
    $('.from-date-material-report').on('dp.change', function () {
        $('.from-date-material-report').val($(this).val());
    });
    $('.to-date-material-report').on('dp.change', function () {
        $('.to-date-material-report').val($(this).val());
    });
    if(!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }

    $('#tabs-form-material li a').on('click', function () {
        typeTabMaterial = $(this).data('tab')
        updateCookieMaterial();
    })
    $('#tabs-form-material li a[data-tab="' + typeTabMaterial + '"]').click()
});

function updateCookieMaterial() {
    saveCookieShared('material-report-user-id-' + idSession, JSON.stringify({
        'tab': typeTabMaterial,
        'from': fromMaterial,
        'to': toMaterial,
    }))
}

async function loadData() {
    let branch = $(".select-branch").val(),
        from = $('.from-date-material-report').val(),
        to = $('.to-date-material-report').val(),
        method = 'get',
        url = 'material-report.data',
        params = {
            branch: branch,
            from: from,
            to: to,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-material-report'),
        $('#table-goods-material-report'),
        $('#table-internal-material-report'),
        $('#table-other-material-report'),
        $('#from-date-material-report'),
    ]);
    dataTableMaterialReport(res);
    dataTotalMaterialReport(res.data[4]);
    dataExcelWarehouseMaterialReport = res.data[5][0].data;
    dataExcelWarehouseReport = res.data[5][1].data;
    dataExcelInternalWarehouseReport = res.data[5][2].data;
    dataExcelOtherWarehouseReport = res.data[5][3].data;
}

async function dataTableMaterialReport(data) {
    let tableMaterialMaterialReport = $('#table-material-material-report'),
        tableGoodsMaterialReport = $('#table-goods-material-report'),
        tableInternalMaterialReport = $('#table-internal-material-report'),
        tableOtherMaterialReport = $('#table-other-material-report'),
        fixed_left = 2,
        fixed_right = 0,
        columnInner = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', class: 'text-left'},
            {data: 'opening_amount', name: 'opening_amount', class: 'text-right'},
            {data: 'receive_from_branch_amount', name: 'receive_from_branch_amount', class: 'text-right'},
            {data: 'receive_from_supplier_amount', name: 'receive_from_supplier_amount', class: 'text-right border-column'},
            {data: 'export_outer_branch_amount', name: 'export_outer_branch_amount', class: 'text-right'},
            {data: 'export_kitchen_amount', name: 'export_kitchen_amount', class: 'text-right'},
            {data: 'export_bar_amount', name: 'export_bar_amount', class: 'text-right'},
            {data: 'export_employee_amount', name: 'export_employee_amount', class: 'text-right'},
            {data: 'export_inner_amount', name: 'export_inner_amount', class: 'text-right'},
            {data: 'cancel_amount', name: 'cancel_amount', class: 'text-right'},
            {data: 'return_amount', name: 'return_amount', class: 'text-right'},
            {data: 'system_last_amount', name: 'system_last_amount', class: 'text-right'},
            {
                data: 'total_receive_from_kitchen_return_amount',
                name: 'total_receive_from_kitchen_return_amount',
                class: 'text-right'
            },
            {
                data: 'total_receive_from_bar_return_amount',
                name: 'total_receive_from_bar_return_amount',
                class: 'text-right'
            },
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', class: 'd-none'}
        ], columnOther = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name',},
            {data: 'opening_amount', name: 'opening_amount', class: 'text-right'},
            {data: 'receive_from_branch_amount', name: 'receive_from_branch_amount', class: 'text-right'},
            {data: 'receive_from_supplier_amount', name: 'receive_from_supplier_amount', class: 'text-right'},
            {data: 'export_outer_branch_amount', name: 'export_outer_branch_amount', class: 'text-right'},
            {data: 'export_kitchen_amount', name: 'export_kitchen_amount', class: 'text-right'},
            {data: 'export_bar_amount', name: 'export_bar_amount', class: 'text-right'},
            {data: 'export_employee_amount', name: 'export_employee_amount', class: 'text-right'},
            {data: 'export_inner_amount', name: 'export_inner_amount', class: 'text-right'},
            {data: 'cancel_amount', name: 'cancel_amount', class: 'text-right'},
            {data: 'return_amount', name: 'return_amount', class: 'text-right'},
            {data: 'system_last_amount', name: 'system_last_amount', class: 'text-right'},
            {
                data: 'total_receive_from_kitchen_return_amount',
                name: 'total_receive_from_kitchen_return_amount',
                class: 'text-right'
            },
            {
                data: 'total_receive_from_bar_return_amount',
                name: 'total_receive_from_bar_return_amount',
                class: 'text-right'
            },
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', class: 'd-none'}
        ],
        option = [
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print',
                'class': 'seemt-btn-hover-blue',
                'function': 'exportExcelMaterialReport',
            }
        ]

    dataTableWarehouseMaterial = await DatatableTemplateNew(tableMaterialMaterialReport, data.data[0].original.data, columnInner, vh_of_table, fixed_left, fixed_right, option);
    dataTableWarehouse = await DatatableTemplateNew(tableGoodsMaterialReport, data.data[1].original.data, columnOther, vh_of_table, fixed_left, fixed_right, option);
    dataTableInternalWarehouse = await DatatableTemplateNew(tableInternalMaterialReport, data.data[2].original.data, columnInner, vh_of_table, fixed_left, fixed_right, option);
    dataTableOtherWarehouse = await DatatableTemplateNew(tableOtherMaterialReport, data.data[3].original.data, columnInner, vh_of_table, fixed_left, fixed_right, option);
    // Tab kho nguyên liệu - Material
    $(document).on('input paste keyup keydown', 'input[type="search"]', async function () {
        $('#total-record-material').text(dataTableWarehouseMaterial.rows({'search': 'applied'}).count());
        $('#total-record-goods').text(dataTableWarehouse.rows({'search': 'applied'}).count());
        $('#total-record-internal').text(dataTableInternalWarehouse.rows({'search': 'applied'}).count());
        $('#total-record-other').text(dataTableOtherWarehouse.rows({'search': 'applied'}).count());
        let totalTableMaterial = searchUpdateTotal(dataTableWarehouseMaterial),
            totalTableGoods = searchUpdateTotal(dataTableWarehouse),
            totalTableInternal = searchUpdateTotal(dataTableInternalWarehouse),
            totalTableOther = searchUpdateTotal(dataTableOtherWarehouse)
        // Kho nguyên liệu
        $('#total-amount-before-material').text(formatNumber(totalTableMaterial[0]))
        $('#total-amount-import-branch-material').text(formatNumber(totalTableMaterial[1]))
        $('#total-amount-import-supplier-material').text(formatNumber(totalTableMaterial[2]))
        $('#total-amount-export-branch-material').text(formatNumber(totalTableMaterial[3]))
        $('#total-amount-export-kitchen-material').text(formatNumber(totalTableMaterial[4]))
        $('#total-amount-export-bar-material').text(formatNumber(totalTableMaterial[5]))
        $('#total-amount-export-employee-material').text(formatNumber(totalTableMaterial[6]))
        $('#total-amount-export-inner-material').text(formatNumber(totalTableMaterial[7]))
        $('#total-amount-cancel-material').text(formatNumber(totalTableMaterial[8]))
        $('#total-amount-after-material').text(formatNumber(totalTableMaterial[9]))
        $('#total-amount-import-kitchen-material').text(formatNumber(totalTableMaterial[10]))
        $('#total-amount-import-bar-material').text(formatNumber(totalTableMaterial[11]))
        $('#total-amount-return-material').text(formatNumber(totalTableMaterial[12]))
        // Kho hàng hóa
        $('#total-amount-before-goods').text(formatNumber(totalTableGoods[0]))
        $('#total-amount-import-branch-goods').text(formatNumber(totalTableGoods[1]))
        $('#total-amount-import-supplier-goods').text(formatNumber(totalTableGoods[2]))
        $('#total-amount-export-branch-goods').text(formatNumber(totalTableGoods[3]))
        $('#total-amount-export-kitchen-goods').text(formatNumber(totalTableGoods[4]))
        $('#total-amount-export-bar-goods').text(formatNumber(totalTableGoods[5]))
        $('#total-amount-export-employee-goods').text(formatNumber(totalTableGoods[6]))
        $('#total-amount-export-inner-goods').text(formatNumber(totalTableGoods[7]))
        $('#total-amount-cancel-goods').text(formatNumber(totalTableGoods[8]))
        $('#total-amount-after-goods').text(formatNumber(totalTableGoods[9]))
        $('#total-amount-import-kitchen-goods').text(formatNumber(totalTableGoods[10]))
        $('#total-amount-import-bar-goods').text(formatNumber(totalTableGoods[11]))
        $('#total-amount-return-goods').text(formatNumber(totalTableGoods[12]))
        // Kho nội bộ
        $('#total-amount-before-internal').text(formatNumber(totalTableInternal[0]))
        $('#total-amount-import-branch-internal').text(formatNumber(totalTableInternal[1]))
        $('#total-amount-import-supplier-internal').text(formatNumber(totalTableInternal[2]))
        $('#total-amount-export-branch-internal').text(formatNumber(totalTableInternal[3]))
        $('#total-amount-export-kitchen-internal').text(formatNumber(totalTableInternal[4]))
        $('#total-amount-export-bar-internal').text(formatNumber(totalTableInternal[5]))
        $('#total-amount-export-employee-internal').text(formatNumber(totalTableInternal[6]))
        $('#total-amount-export-inner-internal').text(formatNumber(totalTableInternal[7]))
        $('#total-amount-cancel-internal').text(formatNumber(totalTableInternal[8]))
        $('#total-amount-after-internal').text(formatNumber(totalTableInternal[9]))
        $('#total-amount-import-kitchen-internal').text(formatNumber(totalTableInternal[10]))
        $('#total-amount-import-bar-internal').text(formatNumber(totalTableInternal[11]))
        $('#total-amount-return-internal').text(formatNumber(totalTableInternal[12]))
        // Kho khác
        $('#total-amount-before-other').text(formatNumber(totalTableOther[0]))
        $('#total-amount-import-branch-other').text(formatNumber(totalTableOther[1]))
        $('#total-amount-import-supplier-other').text(formatNumber(totalTableOther[2]))
        $('#total-amount-export-branch-other').text(formatNumber(totalTableOther[3]))
        $('#total-amount-export-kitchen-other').text(formatNumber(totalTableOther[4]))
        $('#total-amount-export-bar-other').text(formatNumber(totalTableOther[5]))
        $('#total-amount-export-employee-other').text(formatNumber(totalTableOther[6]))
        $('#total-amount-export-inner-other').text(formatNumber(totalTableOther[7]))
        $('#total-amount-cancel-other').text(formatNumber(totalTableOther[8]))
        $('#total-amount-after-other').text(formatNumber(totalTableOther[9]))
        $('#total-amount-import-kitchen-other').text(formatNumber(totalTableOther[10]))
        $('#total-amount-import-bar-other').text(formatNumber(totalTableOther[11]))
        $('#total-amount-return-other').text(formatNumber(totalTableOther[12]))
    })
}
function searchUpdateTotal(datatable){
    let totalAmountBefore = 0,
        totalAmountImportBranch = 0,
        totalAmountImportSupplier = 0,
        totalAmountExportBranch = 0,
        totalAmountExportKitchen = 0,
        totalAmountExportBar = 0,
        totalAmountExportEmployee = 0,
        totalAmountExportInner = 0,
        totalAmountCancel = 0,
        totalAmountReturn = 0,
        totalAmountAfter = 0,
        totalAmountImportKitchen = 0,
        totalAmountImportBarMaterial = 0
    datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        totalAmountBefore += removeformatNumber(row.find('td:eq(2) label:first-child').text())
        totalAmountImportBranch += removeformatNumber(row.find('td:eq(3) label:first-child').text())
        totalAmountImportSupplier += removeformatNumber(row.find('td:eq(4) label:first-child').text())
        totalAmountExportBranch += removeformatNumber(row.find('td:eq(5) label:first-child').text())
        totalAmountExportKitchen += removeformatNumber(row.find('td:eq(6) label:first-child').text())
        totalAmountExportBar += removeformatNumber(row.find('td:eq(7) label:first-child').text())
        totalAmountExportEmployee += removeformatNumber(row.find('td:eq(8) label:first-child').text())
        totalAmountExportInner += removeformatNumber(row.find('td:eq(9) label:first-child').text())
        totalAmountCancel += removeformatNumber(row.find('td:eq(10) label:first-child').text())
        totalAmountReturn += removeformatNumber(row.find('td:eq(11) label:first-child').text())
        totalAmountAfter += removeformatNumber(row.find('td:eq(12) label:first-child').text())
        totalAmountImportKitchen += removeformatNumber(row.find('td:eq(13) label:first-child').text())
        totalAmountImportBarMaterial += removeformatNumber(row.find('td:eq(14) label:first-child').text())
    })
    return [totalAmountBefore, totalAmountImportBranch, totalAmountImportSupplier,
        totalAmountExportBranch, totalAmountExportKitchen, totalAmountExportBar,
        totalAmountExportEmployee, totalAmountExportInner, totalAmountCancel,
        totalAmountAfter, totalAmountImportKitchen, totalAmountImportBarMaterial, totalAmountReturn]
}

function dataTotalMaterialReport(data) {
    /**
     * Material
     */
    $("#total-record-material").html(data.material.record);
    $("#total-quantity-before-material").html(data.material.before_quantity + '<em>sl</em>');
    totalMaterialBeforeAmount = data.material.before_amount;
    $("#total-amount-before-material").html(totalMaterialBeforeAmount);
    $("#total-quantity-import-branch-material").html(data.material.import_branch_quantity + '<em>sl</em>');
    totalMaterialImportBranchAmount = data.material.import_branch_amount;
    $("#total-amount-import-branch-material").html(totalMaterialImportBranchAmount);
    $("#total-quantity-import-supplier-material").html(data.material.import_supplier_quantity + '<em>sl</em>');
    totalMaterialSupplierAmount = data.material.import_supplier_amount;
    $("#total-amount-import-supplier-material").html(totalMaterialSupplierAmount);
    $("#total-quantity-import-kitchen-material").html(data.material.receive_from_kitchen_return_quantity + '<em>sl</em>');
    totalMaterialKitchenReturnAmount = data.material.receive_from_kitchen_return_amount;
    $("#total-amount-import-kitchen-material").html(totalMaterialKitchenReturnAmount);
    $("#total-quantity-import-bar-material").html(data.material.receive_from_bar_return_quantity + '<em>sl</em>');
    totalMaterialBarReturnAmount = data.material.receive_from_bar_return_amount;
    $("#total-amount-import-bar-material").html(totalMaterialBarReturnAmount);
    $("#total-quantity-export-branch-material").html(data.material.export_branch_quantity + '<em>sl</em>');
    totalMaterialExportBranchAmount = data.material.export_branch_amount;
    $("#total-amount-export-branch-material").html(totalMaterialExportBranchAmount);
    $("#total-quantity-export-kitchen-material").html(data.material.export_kitchen_quantity + '<em>sl</em>');
    totalMaterialKitchenAmount = data.material.export_kitchen_amount;
    $("#total-amount-export-kitchen-material").html(totalMaterialKitchenAmount);
    $("#total-quantity-export-bar-material").html(data.material.export_bar_quantity + '<em>sl</em>');
    totalMaterialBarAmount = data.material.export_bar_amount;
    $("#total-amount-export-bar-material").html(totalMaterialBarAmount);
    $("#total-quantity-export-employee-material").html(data.material.export_employee_quantity + '<em>sl</em>');
    totalMaterialEmployeeAmount = data.material.export_employee_amount;
    $("#total-amount-export-employee-material").html(totalMaterialEmployeeAmount);
    $("#total-quantity-export-inner-material").html(data.material.export_inner_quantity + '<em>sl</em>');
    totalMaterialInnerAmount = data.material.export_inner_amount;
    $("#total-amount-export-inner-material").html(totalMaterialInnerAmount);
    $("#total-quantity-export-other-material").html(data.material.export_other_quantity + '<em>sl</em>');
    totalMaterialOtherAmount = data.material.export_other_amount;
    $("#total-amount-export-other-material").html(totalMaterialOtherAmount);
    $("#total-quantity-return-material").html(data.material.return_quantity + '<em>sl</em>');
    totalMaterialReturnAmount = data.material.return_amount;
    $("#total-amount-return-material").html(totalMaterialReturnAmount);
    $("#total-quantity-cancel-material").html(data.material.cancel_quantity + '<em>sl</em>');
    totalMaterialCancelAmount = data.material.cancel_amount;
    $("#total-amount-cancel-material").html(totalMaterialCancelAmount);
    $("#total-quantity-wastage-allow-material").html(data.material.wastage_allow_quantity + '<em>sl</em>');
    totalMaterialWastageAllowAmount = data.material.wastage_allow_amount;
    $("#total-amount-wastage-allow-material").html(totalMaterialWastageAllowAmount);
    $("#total-quantity-after-material").html(data.material.after_quantity + '<em>sl</em>');
    totalMaterialAfterAmount = data.material.after_amount;
    $("#total-amount-after-material").html(totalMaterialAfterAmount);
    /**
     * Goods
     */
    $("#total-record-goods").text(data.goods.record);
    $("#total-quantity-before-goods").html(data.goods.before_quantity  + '<em>sl</em>');
    totalGoodsBeforeAmount = data.goods.before_amount;
    $("#total-amount-before-goods").html(totalGoodsBeforeAmount);
    $("#total-quantity-import-branch-goods").html(data.goods.import_branch_quantity  + '<em>sl</em>');
    totalGoodsImportBranchAmount = data.goods.import_branch_amount;
    $("#total-amount-import-branch-goods").html(totalGoodsImportBranchAmount);
    $("#total-quantity-import-supplier-goods").html(data.goods.import_supplier_quantity  + '<em>sl</em>');
    totalGoodsSupplierAmount = data.goods.import_supplier_amount;
    $("#total-amount-import-supplier-goods").html(totalGoodsSupplierAmount);
    $("#total-quantity-import-kitchen-goods").html(data.goods.receive_from_kitchen_return_quantity  + '<em>sl</em>');
    totalGoodsKitchenReturnAmount = data.goods.receive_from_kitchen_return_amount;
    $("#total-amount-import-kitchen-goods").html(totalGoodsKitchenReturnAmount);
    $("#total-quantity-import-bar-goods").html(data.goods.receive_from_bar_return_quantity  + '<em>sl</em>');
    totalGoodsBarReturnAmount = data.goods.receive_from_bar_return_amount;
    $("#total-amount-import-bar-goods").html(totalGoodsBarReturnAmount);
    $("#total-quantity-export-branch-goods").html(data.goods.export_branch_quantity  + '<em>sl</em>');
    totalGoodsExportBranchAmount = data.goods.export_branch_amount;
    $("#total-amount-export-branch-goods").html(totalGoodsExportBranchAmount);
    $("#total-quantity-export-kitchen-goods").html(data.goods.export_kitchen_quantity  + '<em>sl</em>');
    totalGoodsKitchenAmount = data.goods.export_kitchen_amount;
    $("#total-amount-export-kitchen-goods").html(totalGoodsKitchenAmount);
    $("#total-quantity-export-bar-goods").html(data.goods.export_bar_quantity  + '<em>sl</em>');
    totalGoodsBarAmount = data.goods.export_bar_amount;
    $("#total-amount-export-bar-goods").html(totalGoodsBarAmount);
    $("#total-quantity-export-employee-goods").html(data.goods.export_employee_quantity  + '<em>sl</em>');
    totalGoodsEmployeeAmount = data.goods.export_employee_amount;
    $("#total-amount-export-employee-goods").html(totalGoodsEmployeeAmount);
    $("#total-quantity-export-inner-goods").html(data.goods.export_inner_quantity  + '<em>sl</em>');
    totalGoodsInnerAmount = data.goods.export_inner_amount;
    $("#total-amount-export-inner-goods").html(totalGoodsInnerAmount);
    $("#total-quantity-export-other-goods").html(data.goods.export_other_quantity  + '<em>sl</em>');
    totalGoodsOtherAmount = data.goods.export_other_amount;
    $("#total-amount-export-other-goods").html(totalGoodsOtherAmount);
    $("#total-quantity-return-goods").html(data.goods.return_quantity  + '<em>sl</em>');
    totalGoodsReturnAmount = data.goods.return_amount;
    $("#total-amount-return-goods").html(totalGoodsReturnAmount);
    $("#total-quantity-cancel-goods").html(data.goods.cancel_quantity  + '<em>sl</em>');
    totalGoodsCancelAmount = data.goods.cancel_amount;
    $("#total-amount-cancel-goods").html(totalGoodsCancelAmount);
    $("#total-quantity-wastage-allow-goods").html(data.goods.wastage_allow_quantity  + '<em>sl</em>');
    totalGoodsWastageAllowAmount = data.goods.wastage_allow_amount;
    $("#total-amount-wastage-allow-goods").html(totalGoodsWastageAllowAmount);
    $("#total-quantity-after-goods").html(data.goods.after_quantity  + '<em>sl</em>');
    totalGoodsAfterAmount = data.goods.after_amount;
    $("#total-amount-after-goods").html(totalGoodsAfterAmount);
    /**
     * Internal
     */
    $("#total-record-internal").text(data.internal.record);
    $("#total-quantity-before-internal").html(data.internal.before_quantity  + '<em>sl</em>');
    totalInternalBeforeAmount = data.internal.before_amount;
    $("#total-amount-before-internal").html(totalInternalBeforeAmount);
    $("#total-quantity-import-branch-internal").html(data.internal.import_branch_quantity  + '<em>sl</em>');
    totalInternalImportBranchAmount = data.internal.import_branch_amount;
    $("#total-amount-import-branch-internal").html(totalInternalImportBranchAmount);
    $("#total-quantity-import-supplier-internal").html(data.internal.import_supplier_quantity  + '<em>sl</em>');
    totalInternalSupplierAmount = data.internal.import_supplier_amount;
    $("#total-amount-import-supplier-internal").html(totalInternalSupplierAmount);
    $("#total-quantity-import-kitchen-internal").html(data.internal.receive_from_kitchen_return_quantity  + '<em>sl</em>');
    totalInternalKitchenReturnAmount = data.internal.receive_from_kitchen_return_amount;
    $("#total-amount-import-kitchen-internal").html(totalInternalKitchenReturnAmount);
    $("#total-quantity-import-bar-internal").html(data.internal.receive_from_bar_return_quantity  + '<em>sl</em>');
    totalInternalBarReturnAmount = data.internal.receive_from_bar_return_amount;
    $("#total-amount-import-bar-internal").html(totalInternalBarReturnAmount);
    $("#total-quantity-export-branch-internal").html(data.internal.export_branch_quantity  + '<em>sl</em>');
    totalInternalExportBranchAmount = data.internal.export_branch_amount;
    $("#total-amount-export-branch-internal").html(totalInternalExportBranchAmount);
    $("#total-quantity-export-kitchen-internal").html(data.internal.export_kitchen_quantity  + '<em>sl</em>');
    totalInternalKitchenAmount = data.internal.export_kitchen_amount;
    $("#total-amount-export-kitchen-internal").html(totalInternalKitchenAmount);
    $("#total-quantity-export-bar-internal").html(data.internal.export_bar_quantity  + '<em>sl</em>');
    totalInternalBarAmount = data.internal.export_bar_amount;
    $("#total-amount-export-bar-internal").html(totalInternalBarAmount);
    $("#total-quantity-export-employee-internal").html(data.internal.export_employee_quantity  + '<em>sl</em>');
    totalInternalEmployeeAmount = data.internal.export_employee_amount;
    $("#total-amount-export-employee-internal").html(totalInternalEmployeeAmount);
    $("#total-quantity-export-inner-internal").html(data.internal.export_inner_quantity  + '<em>sl</em>');
    totalInternalInnerAmount = data.internal.export_inner_amount;
    $("#total-amount-export-inner-internal").html(totalInternalInnerAmount);
    $("#total-quantity-export-other-internal").html(data.internal.export_other_quantity  + '<em>sl</em>');
    totalInternalOtherAmount = data.internal.export_other_amount;
    $("#total-amount-export-other-internal").html(totalInternalOtherAmount);
    $("#total-quantity-return-internal").html(data.internal.return_quantity  + '<em>sl</em>');
    totalInternalReturnAmount = data.internal.return_amount;
    $("#total-amount-return-internal").html(totalInternalReturnAmount);
    $("#total-quantity-cancel-internal").html(data.internal.cancel_quantity  + '<em>sl</em>');
    totalInternalCancelAmount = data.internal.cancel_amount;
    $("#total-amount-cancel-internal").html(totalInternalCancelAmount);
    $("#total-quantity-wastage-allow-internal").html(data.internal.wastage_allow_quantity  + '<em>sl</em>');
    totalInternalWastageAllowAmount = data.internal.wastage_allow_amount;
    $("#total-amount-wastage-allow-internal").html(totalInternalWastageAllowAmount);
    $("#total-quantity-after-internal").html(data.internal.after_quantity  + '<em>sl</em>');
    totalInternalAfterAmount = data.internal.after_amount;
    $("#total-amount-after-internal").html(totalInternalAfterAmount);
    /**
     * Other
     */
    $("#total-record-other").text(data.other.record);
    $("#total-quantity-before-other").html(data.other.before_quantity  + '<em>sl</em>');
    totalOtherBeforeAmount = data.other.before_amount;
    $("#total-amount-before-other").html(totalOtherBeforeAmount);
    $("#total-quantity-import-branch-other").html(data.other.import_branch_quantity  + '<em>sl</em>');
    totalOtherImportBranchAmount = data.other.import_branch_amount;
    $("#total-amount-import-branch-other").html(totalOtherImportBranchAmount);
    $("#total-quantity-import-supplier-other").html(data.other.import_supplier_quantity  + '<em>sl</em>');
    totalOtherSupplierAmount = data.other.import_supplier_amount;
    $("#total-amount-import-supplier-other").html(totalOtherSupplierAmount);
    $("#total-quantity-import-kitchen-other").html(data.other.receive_from_kitchen_return_quantity  + '<em>sl</em>');
    totalOtherKitchenReturnAmount = data.other.receive_from_kitchen_return_amount;
    $("#total-amount-import-kitchen-other").html(totalOtherKitchenReturnAmount);
    $("#total-quantity-import-bar-other").html(data.other.receive_from_bar_return_quantity  + '<em>sl</em>');
    totalOtherBarReturnAmount = data.other.receive_from_bar_return_amount;
    $("#total-amount-import-bar-other").html(totalOtherBarReturnAmount);
    $("#total-quantity-export-branch-other").html(data.other.export_branch_quantity  + '<em>sl</em>');
    totalOtherExportBranchAmount = data.other.export_branch_amount;
    $("#total-amount-export-branch-other").html(totalOtherExportBranchAmount);
    $("#total-quantity-export-kitchen-other").html(data.other.export_kitchen_quantity  + '<em>sl</em>');
    totalOtherKitchenAmount = data.other.export_kitchen_amount;
    $("#total-amount-export-kitchen-other").html(totalOtherKitchenAmount);
    $("#total-quantity-export-bar-other").html(data.other.export_bar_quantity  + '<em>sl</em>');
    totalOtherBarAmount = data.other.export_bar_amount;
    $("#total-amount-export-bar-other").html(totalOtherBarAmount);
    $("#total-quantity-export-employee-other").html(data.other.export_employee_quantity  + '<em>sl</em>');
    totalOtherEmployeeAmount = data.other.export_employee_amount;
    $("#total-amount-export-employee-other").html(totalOtherEmployeeAmount);
    $("#total-quantity-export-inner-other").html(data.other.export_inner_quantity  + '<em>sl</em>');
    totalOtherInnerAmount = data.other.export_inner_amount;
    $("#total-amount-export-inner-other").html(totalOtherInnerAmount);
    $("#total-quantity-export-other-other").html(data.other.export_other_quantity  + '<em>sl</em>');
    totalOtherOtherAmount = data.other.export_other_amount;
    $("#total-amount-export-other-other").html(totalOtherOtherAmount);
    $("#total-quantity-return-other").html(data.other.return_quantity  + '<em>sl</em>');
    totalOtherReturnAmount = data.other.return_amount;
    $("#total-amount-return-other").html(totalOtherReturnAmount);
    $("#total-quantity-cancel-other").html(data.other.cancel_quantity  + '<em>sl</em>');
    totalOtherCancelAmount = data.other.cancel_amount;
    $("#total-amount-cancel-other").html(totalOtherCancelAmount);
    $("#total-quantity-wastage-allow-other").html(data.other.wastage_allow_quantity  + '<em>sl</em>');
    totalOtherWastageAllowAmount = data.other.wastage_allow_amount;
    $("#total-amount-wastage-allow-other").html(totalOtherWastageAllowAmount);
    $("#total-quantity-after-other").html(data.other.after_quantity  + '<em>sl</em>');
    totalOtherAfterAmount = data.other.after_amount;
    $("#total-amount-after-other").html(totalOtherAfterAmount);
}
