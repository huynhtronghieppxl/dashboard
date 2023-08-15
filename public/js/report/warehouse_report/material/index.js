let dataTableMaterial = null, dataTableGoods = null, dataTableInternal = null, dataTableOther = null,
    typeTabMaterial = 1, fromMaterial = $('.from-date-material-report').val(), toMaterial = $('.to-date-material-report').val();
let dataExcelWarehouseMaterialReport, dataExcelWarehouseReport, dataExcelInternalWarehouseReport, dataExcelOtherWarehouseReport;
$(function () {
    if (getCookieShared('material-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('material-report-user-id-' + idSession));
        typeTabMaterial = dataCookie.tab
        fromMaterial = dataCookie.from
        toMaterial = dataCookie.to
        $('.from-date-material-report').val(fromMaterial)
        $('.to-date-material-report').val(toMaterial)
    }
    dateTimePickerTemplate($('.from-date-material-report'));
    dateTimePickerTemplate($('.to-date-material-report'));
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
    loadData();

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
        url = 'warehouse-material-report.data',
        params = {
            branch: branch,
            from: from,
            to: to,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-warehouse-report'),
        $('#table-goods-warehouse-report'),
        $('#table-internal-warehouse-report'),
        $('#table-other-warehouse-report'),
        $('#from-date-warehouse-report'),
    ]);
    dataTableMaterialWarehouseReport(res);
    dataTotalMaterialReport(res.data[4]);
    dataExcelWarehouseMaterialReport = res.data[5][0].data;
    dataExcelWarehouseReport = res.data[5][1].data;
    dataExcelInternalWarehouseReport = res.data[5][2].data;
    dataExcelOtherWarehouseReport = res.data[5][3].data;
}

async function dataTableMaterialWarehouseReport(data) {
    let tableMaterialMaterialReport = $('#table-material-warehouse-report'),
        tableGoodsMaterialReport = $('#table-goods-warehouse-report'),
        tableInternalMaterialReport = $('#table-internal-warehouse-report'),
        tableOtherMaterialReport = $('#table-other-warehouse-report'),
        fixed_left = 2,
        fixed_right = 0,
        columnInner = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', class: 'text-left'},
            {data: 'opening_amount', name: 'opening_amount', class: 'text-right'},
            {data: 'receive_from_supplier_amount', name: 'receive_from_supplier_amount', class: 'text-right'},
            {data: 'export_outer_branch_amount', name: 'export_outer_branch_amount', class: 'text-right'},
            {data: 'cancel_amount', name: 'cancel_amount', class: 'text-right'},
            {data: 'system_last_amount', name: 'system_last_amount', class: 'text-right'},
            {data: 'receive_from_branch_amount', name: 'receive_from_branch_amount', class: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', class: 'd-none'}
        ], columnOther = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name',},
            {data: 'opening_amount', name: 'opening_amount', class: 'text-center'},
            {data: 'receive_from_supplier_amount', name: 'receive_from_supplier_amount', class: 'text-center'},
            {data: 'export_outer_branch_amount', name: 'export_outer_branch_amount', class: 'text-center'},
            {data: 'cancel_amount', name: 'cancel_amount', class: 'text-center'},
            {data: 'system_last_amount', name: 'system_last_amount', class: 'text-center'},
            {data: 'receive_from_branch_amount', name: 'receive_from_branch_amount', class: 'text-center'},
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

    dataTableMaterial = await DatatableTemplateNew(tableMaterialMaterialReport, data.data[0].original.data, columnInner, vh_of_table, fixed_left, fixed_right, option);
    dataTableGoods = await DatatableTemplateNew(tableGoodsMaterialReport, data.data[1].original.data, columnOther, vh_of_table, fixed_left, fixed_right, option);
    dataTableInternal = await DatatableTemplateNew(tableInternalMaterialReport, data.data[2].original.data, columnInner, vh_of_table, fixed_left, fixed_right, option);
    dataTableOther = await DatatableTemplateNew(tableOtherMaterialReport, data.data[3].original.data, columnInner, vh_of_table, fixed_left, fixed_right, option);
    // Tab kho nguyên liệu - Material
    $(document).on('input paste keyup keydown', 'input[type="search"]', async function () {
        $('#total-record-material').text(dataTableMaterial.rows({'search': 'applied'}).count());
        $('#total-record-goods').text(dataTableGoods.rows({'search': 'applied'}).count());
        $('#total-record-internal').text(dataTableInternal.rows({'search': 'applied'}).count());
        $('#total-record-other').text(dataTableOther.rows({'search': 'applied'}).count());
        let totalTableMaterial = searchUpdateTotal(dataTableMaterial),
            totalTableGoods = searchUpdateTotal(dataTableGoods),
            totalTableInternal = searchUpdateTotal(dataTableInternal),
            totalTableOther = searchUpdateTotal(dataTableOther)
        // Kho nguyên liệu
        $('#total-amount-before-warehouse-material').text(formatNumber(totalTableMaterial[0]))
        $('#total-quantity-import-materials').text(formatNumber(totalTableMaterial[1]))
        $('#total-quantity-exports-materials').text(formatNumber(totalTableMaterial[2]))
        $('#total-amount-destroy-materials').text(formatNumber(totalTableMaterial[3]))
        $('#total-system-inventory').text(formatNumber(totalTableMaterial[4]))
        $('#total-amount-warehouses-branch-to-pay').text(formatNumber(totalTableMaterial[5]))
        // Kho hàng hóa
        $('#total-amount-before-warehouse-goods').text(formatNumber(totalTableGoods[0]))
        $('#total-amount-import-goods').text(formatNumber(totalTableGoods[1]))
        $('#total-quantity-exports-goods').text(formatNumber(totalTableGoods[2]))
        $('#total-amount-destroy-goods').text(formatNumber(totalTableGoods[3]))
        $('#total-system-inventory-goods').text(formatNumber(totalTableGoods[4]))
        $('#total-amount-warehouses-branch-to-pay-goods').text(formatNumber(totalTableGoods[5]))
        // Kho nội bộ
        $('#total-amount-before-warehouse-internal').text(formatNumber(totalTableInternal[0]))
        $('#total-amount-import-internal').text(formatNumber(totalTableInternal[1]))
        $('#total-quantity-exports-internal').text(formatNumber(totalTableInternal[2]))
        $('#total-amount-destroy-internal').text(formatNumber(totalTableInternal[3]))
        $('#total-system-inventory-internal').text(formatNumber(totalTableInternal[4]))
        $('#total-amount-warehouses-branch-to-pay-internal').text(formatNumber(totalTableInternal[5]))
        // Kho khác
        $('#total-amount-before-warehouse-other').text(formatNumber(totalTableOther[0]))
        $('#total-amount-import-other').text(formatNumber(totalTableOther[1]))
        $('#total-quantity-exports-other').text(formatNumber(totalTableOther[2]))
        $('#total-amount-destroy-other').text(formatNumber(totalTableOther[3]))
        $('#total-system-inventory-other').text(formatNumber(totalTableOther[4]))
        $('#total-amount-warehouses-branch-to-pay-other').text(formatNumber(totalTableOther[5]))
    })
}
function searchUpdateTotal(datatable){
    let totalAmountBefore = 0,
        totalAmountImportSupplier = 0,
        totalAmountExportBranch = 0,
        totalAmountCancel = 0,
        totalAmountImportBranch = 0,
        totalAmountAfter = 0
    datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        totalAmountBefore += removeformatNumber(row.find('td:eq(2) label:first-child').text())
        totalAmountImportSupplier += removeformatNumber(row.find('td:eq(3) label:first-child').text())
        totalAmountExportBranch += removeformatNumber(row.find('td:eq(4) label:first-child').text())
        totalAmountCancel += removeformatNumber(row.find('td:eq(5) label:first-child').text())
        totalAmountImportBranch += removeformatNumber(row.find('td:eq(6) label:first-child').text())
        totalAmountAfter += removeformatNumber(row.find('td:eq(7) label:first-child').text())
    })
    return [totalAmountBefore, totalAmountImportSupplier, totalAmountExportBranch,
        totalAmountCancel, totalAmountImportBranch, totalAmountAfter]
}

function dataTotalMaterialReport(data) {
    /**
     * Material
     */
    $("#total-record-warehouse-material").html(data.material.record);
    totalMaterialBeforeAmount = data.material.before_amount;
    $("#total-amount-before-warehouse-material").html(totalMaterialBeforeAmount);
    totalMaterialSupplierAmount = data.material.import_supplier_amount;
    $("#total-quantity-import-materials").html(totalMaterialSupplierAmount);
    totalMaterialExportBranchAmount = data.material.export_branch_amount;
    $("#total-quantity-exports-materials").html(totalMaterialExportBranchAmount);
    totalMaterialCancelAmount = data.material.cancel_amount;
    $("#total-amount-destroy-materials").html(totalMaterialCancelAmount);
    totalMaterialAfterAmount = data.material.after_amount;
    $("#total-system-inventory").html(totalMaterialAfterAmount);
    totalMaterialImportBranchAmount = data.material.import_branch_amount;
    $("#total-amount-warehouses-branch-to-pay").html(totalMaterialImportBranchAmount);
    /**
     * Goods
     */
    $("#total-record-warehouse-goods").text(data.goods.record);
    totalGoodsBeforeAmount = data.goods.before_amount;
    $("#total-amount-before-warehouse-goods").html(totalGoodsBeforeAmount);
    totalGoodsExportBranchAmount = data.goods.export_branch_amount;
    $("#total-amount-import-goods").html(totalGoodsExportBranchAmount);
    totalGoodsSupplierAmount = data.goods.import_supplier_amount;
    $("#total-quantity-exports-goods").html(totalGoodsSupplierAmount);
    totalGoodsCancelAmount = data.goods.cancel_amount;
    $("#total-amount-destroy-goods").html(totalGoodsCancelAmount);
    totalGoodsAfterAmount = data.goods.after_amount;
    $("#total-system-inventory-goods").html(totalGoodsAfterAmount);
    totalGoodsImportBranchAmount = data.goods.import_branch_amount;
    $("#total-amount-warehouses-branch-to-pay-goods").html(totalGoodsImportBranchAmount);
    /**
     * Internal
     */
    $("#total-record-warehouse-internal").text(data.internal.record);
    totalInternalBeforeAmount = data.internal.before_amount;
    $("#total-amount-before-warehouse-internal").html(totalInternalBeforeAmount);
    totalInternalExportBranchAmount = data.internal.export_branch_amount;
    $("#total-amount-import-internal").html(totalInternalExportBranchAmount);
    totalInternalSupplierAmount = data.internal.import_supplier_amount;
    $("#total-quantity-exports-internal").html(totalInternalSupplierAmount);
    totalInternalCancelAmount = data.internal.cancel_amount;
    $("#total-amount-destroy-internal").html(totalInternalCancelAmount);
    totalInternalAfterAmount = data.internal.after_amount;
    $("#total-system-inventory-internal").html(totalInternalAfterAmount);
    totalInternalImportBranchAmount = data.internal.import_branch_amount;
    $("#total-amount-warehouses-branch-to-pay-internal").html(totalInternalImportBranchAmount);
    /**
     * Other
     */
    $("#total-record-warehouse-other").text(data.other.record);
    totalOtherBeforeAmount = data.other.before_amount;
    $("#total-amount-before-warehouse-other").html(totalOtherBeforeAmount);
    totalOtherExportBranchAmount = data.other.export_branch_amount;
    $("#total-amount-import-other").html(totalOtherExportBranchAmount);
    totalOtherSupplierAmount = data.other.import_supplier_amount;
    $("#total-quantity-exports-other").html(totalOtherSupplierAmount);
    totalOtherCancelAmount = data.other.cancel_amount;
    $("#total-amount-destroy-other").html(totalOtherCancelAmount);
    totalOtherAfterAmount = data.other.after_amount;
    $("#total-system-inventory-other").html(totalOtherAfterAmount);
    totalOtherImportBranchAmount = data.other.import_branch_amount;
    $("#total-amount-warehouses-branch-to-pay-other").html(totalOtherImportBranchAmount);
}
