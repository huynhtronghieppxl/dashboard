let dataTableWarehouseMaterial = null,
    dataTableWarehouse = null,
    dataTableInternalWarehouse = null,
    dataTableOtherWarehouse = null;
$(function () {
    addLoading("material-report.data");
    dateTimePickerTemplate($('#from-date-material-report'));
    dateTimePickerTemplate($('#to-date-material-report'));
    $('#search-btn-material-report').on('click', function () {
        loadData();
    });
    loadData();
});

async function loadData() {
    let branch = $(".select-branch").val(),
        from = $('#from-date-material-report').val(),
        to = $('#to-date-material-report').val(),
        method = 'get',
        url = 'material-report.data2',
        params = {
            branch: branch,
            from: from,
            to: to,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    await dataTableMaterialReport($('#table-material-material-report'), res.data[0]);
    $('#table-material-material-report').tableHeadFixer({
        head: true,
        foot: false,
        left: 2,
        right: 0,
        'z-index': 0
    });

}

async function dataTableMaterialReport(id, data) {
    id.find('tbody').html(data);
    id.footable({
        "paging": {
            "enabled": true,
            "size": 25
        },
        "sorting": {
            "enabled": false
        },
        "filtering": true
    });

}

function dataTotalMaterialReport(data) {
    /**
     * Material
     */
    $("#total-record-material").text(data.material.record);
    $("#total-quantity-before-material").text(data.material.before_quantity);
    $("#total-amount-before-material").text(data.material.before_amount);
    $("#total-quantity-import-branch-material").text(data.material.import_branch_quantity);
    $("#total-amount-import-branch-material").text(data.material.import_branch_amount);
    $("#total-quantity-import-supplier-material").text(data.material.import_supplier_quantity);
    $("#total-amount-import-supplier-material").text(data.material.import_supplier_amount);
    $("#total-quantity-import-kitchen-material").text(data.material.import_kitchen_quantity);
    $("#total-amount-import-kitchen-material").text(data.material.import_kitchen_amount);
    $("#total-quantity-import-bar-material").text(data.material.import_bar_quantity);
    $("#total-amount-import-bar-material").text(data.material.import_bar_amount);
    $("#total-quantity-export-branch-material").text(data.material.export_branch_quantity);
    $("#total-amount-export-branch-material").text(data.material.export_branch_amount);
    $("#total-quantity-export-kitchen-material").text(data.material.export_kitchen_quantity);
    $("#total-amount-export-kitchen-material").text(data.material.export_kitchen_amount);
    $("#total-quantity-export-bar-material").text(data.material.export_bar_quantity);
    $("#total-amount-export-bar-material").text(data.material.export_bar_amount);
    $("#total-quantity-export-employee-material").text(data.material.export_employee_quantity);
    $("#total-amount-export-employee-material").text(data.material.export_employee_amount);
    $("#total-quantity-export-inner-material").text(data.material.export_inner_quantity);
    $("#total-amount-export-inner-material").text(data.material.export_inner_amount);
    $("#total-quantity-export-other-material").text(data.material.export_other_quantity);
    $("#total-amount-export-other-material").text(data.material.export_other_amount);
    $("#total-quantity-return-material").text(data.material.return_quantity);
    $("#total-amount-return-material").text(data.material.return_amount);
    $("#total-quantity-cancel-material").text(data.material.cancel_quantity);
    $("#total-amount-cancel-material").html(data.material.cancel_amount + '<em>vnd</em>');
    $("#total-quantity-wastage-allow-material").text(data.material.wastage_allow_quantity);
    $("#total-amount-wastage-allow-material").text(data.material.wastage_allow_amount);
    $("#total-quantity-after-material").text(data.material.after_quantity);
    $("#total-amount-after-material").text(data.material.after_amount);
    /**
     * Goods
     */
    $("#total-record-goods").text(data.goods.record);
    $("#total-quantity-before-goods").text(data.goods.before_quantity);
    $("#total-amount-before-goods").text(data.goods.before_amount);
    $("#total-quantity-import-branch-goods").text(data.goods.import_branch_quantity);
    $("#total-amount-import-branch-goods").text(data.goods.import_branch_amount);
    $("#total-quantity-import-supplier-goods").text(data.goods.import_supplier_quantity);
    $("#total-amount-import-supplier-goods").text(data.goods.import_supplier_amount);
    $("#total-quantity-import-kitchen-goods").text(data.material.import_kitchen_quantity);
    $("#total-amount-import-kitchen-goods").text(data.material.import_kitchen_amount);
    $("#total-quantity-import-bar-goods").text(data.material.import_bar_quantity);
    $("#total-amount-import-bar-goods").text(data.material.import_bar_amount);
    $("#total-quantity-export-branch-goods").text(data.goods.export_branch_quantity);
    $("#total-amount-export-branch-goods").text(data.goods.export_branch_amount);
    $("#total-quantity-export-kitchen-goods").text(data.goods.export_kitchen_quantity);
    $("#total-amount-export-kitchen-goods").text(data.goods.export_kitchen_amount);
    $("#total-quantity-export-bar-goods").text(data.goods.export_bar_quantity);
    $("#total-amount-export-bar-goods").text(data.goods.export_bar_amount);
    $("#total-quantity-export-employee-goods").text(data.goods.export_employee_quantity);
    $("#total-amount-export-employee-goods").text(data.goods.export_employee_amount);
    $("#total-quantity-export-inner-goods").text(data.goods.export_inner_quantity);
    $("#total-amount-export-inner-goods").text(data.goods.export_inner_amount);
    $("#total-quantity-export-other-goods").text(data.goods.export_other_quantity);
    $("#total-amount-export-other-goods").text(data.goods.export_other_amount);
    $("#total-quantity-return-goods").text(data.goods.return_quantity);
    $("#total-amount-return-goods").text(data.goods.return_amount);
    $("#total-quantity-cancel-goods").text(data.goods.cancel_quantity);
    $("#total-amount-cancel-goods").text(data.goods.cancel_amount);
    $("#total-quantity-wastage-allow-goods").text(data.goods.wastage_allow_quantity);
    $("#total-amount-wastage-allow-goods").text(data.goods.wastage_allow_amount);
    $("#total-quantity-after-goods").text(data.goods.after_quantity);
    $("#total-amount-after-goods").text(data.goods.after_amount);
    /**
     * Internal
     */
    $("#total-record-internal").text(data.internal.record);
    $("#total-quantity-before-internal").text(data.internal.before_quantity);
    $("#total-amount-before-internal").text(data.internal.before_amount);
    $("#total-quantity-import-branch-internal").text(data.internal.import_branch_quantity);
    $("#total-amount-import-branch-internal").text(data.internal.import_branch_amount);
    $("#total-quantity-import-supplier-internal").text(data.internal.import_supplier_quantity);
    $("#total-amount-import-supplier-internal").text(data.internal.import_supplier_amount);
    $("#total-quantity-import-kitchen-internal").text(data.material.import_kitchen_quantity);
    $("#total-amount-import-kitchen-internal").text(data.material.import_kitchen_amount);
    $("#total-quantity-import-bar-internal").text(data.material.import_bar_quantity);
    $("#total-amount-import-bar-internal").text(data.material.import_bar_amount);
    $("#total-quantity-export-branch-internal").text(data.internal.export_branch_quantity);
    $("#total-amount-export-branch-internal").text(data.internal.export_branch_amount);
    $("#total-quantity-export-kitchen-internal").text(data.internal.export_kitchen_quantity);
    $("#total-amount-export-kitchen-internal").text(data.internal.export_kitchen_amount);
    $("#total-quantity-export-bar-internal").text(data.internal.export_bar_quantity);
    $("#total-amount-export-bar-internal").text(data.internal.export_bar_amount);
    $("#total-quantity-export-employee-internal").text(data.internal.export_employee_quantity);
    $("#total-amount-export-employee-internal").text(data.internal.export_employee_amount);
    $("#total-quantity-export-inner-internal").text(data.internal.export_inner_quantity);
    $("#total-amount-export-inner-internal").text(data.internal.export_inner_amount);
    $("#total-quantity-export-other-internal").text(data.internal.export_other_quantity);
    $("#total-amount-export-other-internal").text(data.internal.export_other_amount);
    $("#total-quantity-return-internal").text(data.internal.return_quantity);
    $("#total-amount-return-internal").text(data.internal.return_amount);
    $("#total-quantity-cancel-internal").text(data.internal.cancel_quantity);
    $("#total-amount-cancel-internal").text(data.internal.cancel_amount);
    $("#total-quantity-wastage-allow-internal").text(data.internal.wastage_allow_quantity);
    $("#total-amount-wastage-allow-internal").text(data.internal.wastage_allow_amount);
    $("#total-quantity-after-internal").text(data.internal.after_quantity);
    $("#total-amount-after-internal").text(data.internal.after_amount);
    /**
     * Other
     */
    $("#total-record-other").text(data.other.record);
    $("#total-quantity-before-other").text(data.other.before_quantity);
    $("#total-amount-before-other").text(data.other.before_amount);
    $("#total-quantity-import-branch-other").text(data.other.import_branch_quantity);
    $("#total-amount-import-branch-other").text(data.other.import_branch_amount);
    $("#total-quantity-import-supplier-other").text(data.other.import_supplier_quantity);
    $("#total-amount-import-supplier-other").text(data.other.import_supplier_amount);
    $("#total-quantity-import-kitchen-other").text(data.material.import_kitchen_quantity);
    $("#total-amount-import-kitchen-other").text(data.material.import_kitchen_amount);
    $("#total-quantity-import-bar-other").text(data.material.import_bar_quantity);
    $("#total-amount-import-bar-other").text(data.material.import_bar_amount);
    $("#total-quantity-export-branch-other").text(data.other.export_branch_quantity);
    $("#total-amount-export-branch-other").text(data.other.export_branch_amount);
    $("#total-quantity-export-kitchen-other").text(data.other.export_kitchen_quantity);
    $("#total-amount-export-kitchen-other").text(data.other.export_kitchen_amount);
    $("#total-quantity-export-bar-other").text(data.other.export_bar_quantity);
    $("#total-amount-export-bar-other").text(data.other.export_bar_amount);
    $("#total-quantity-export-employee-other").text(data.other.export_employee_quantity);
    $("#total-amount-export-employee-other").text(data.other.export_employee_amount);
    $("#total-quantity-export-inner-other").text(data.other.export_inner_quantity);
    $("#total-amount-export-inner-other").text(data.other.export_inner_amount);
    $("#total-quantity-export-other-other").text(data.other.export_other_quantity);
    $("#total-amount-export-other-other").text(data.other.export_other_amount);
    $("#total-quantity-return-other").text(data.other.return_quantity);
    $("#total-amount-return-other").text(data.other.return_amount);
    $("#total-quantity-cancel-other").text(data.other.cancel_quantity);
    $("#total-amount-cancel-other").text(data.other.cancel_amount);
    $("#total-quantity-wastage-allow-other").text(data.other.wastage_allow_quantity);
    $("#total-amount-wastage-allow-other").text(data.other.wastage_allow_amount);
    $("#total-quantity-after-other").text(data.other.after_quantity);
    $("#total-amount-after-other").text(data.other.after_amount);
}


