let inventoryInternalKitchen, inventoryInternalBar, tabChangeInventoryInternal = 1,
    fromCheckDateKitchenInventory = '',
    toCheckDateKitchenInventory = '',
    fromCheckDateBarInventory = '',
    toCheckDateBarInventory = '',
    tableInventoryInternalReport;

$(async function () {
    $('.search-btn-inventory-kitchen-report').on('click', function () {
        let from = $('#select-from-inventory-internal-kitchen-report option:selected').data('time')
        let to = $('#select-to-inventory-internal-kitchen-report option:selected').data('time')
        if (moment(from, 'DD/MM/YYYY').isAfter(moment(to, 'DD/MM/YYYY'))) {
            $('.notification-filter').attr({
                'data-toggle': 'tooltip',
                'data-placement': 'top',
                'data-original-title': 'Ngày bắt đầu không được lớn hơn ngày kết thúc !'
            })
            $(this).parents('.select-custom-report').find('.notification-filter').tooltip('show');
            return false;
        }
        $(this).parents('.select-custom-report').find('.notification-filter').removeAttr(
            'data-toggle data-placement data-original-title'
        )

        fromCheckDateKitchenInventory = $('#select-from-inventory-internal-kitchen-report').val();
        toCheckDateKitchenInventory = $('#select-to-inventory-internal-kitchen-report').val();
        updateCookieInventoryInternalData();
        loadDataMaterial($('#table-kitchen-inventory-internal-report'), 1, fromCheckDateKitchenInventory, toCheckDateKitchenInventory);
    });
    $('#tabs-form-inventory-internal .nav-link').on('click', function () {
        let from, to;
        tabChangeInventoryInternal = $(this).attr('data-id')
        updateCookieInventoryInternalData()
        switch ($(this).attr('href')) {
            case '#tab1-inventory-internal-report':
                from = $('#select-from-inventory-internal-kitchen-report').val();
                to = $('#select-to-inventory-internal-kitchen-report').val();
                loadDataMaterial($('#table-kitchen-inventory-internal-report'), 1, from, to);
                break;
            case '#tab2-inventory-internal-report':
                from = $('#select-from-inventory-internal-bar-report').val();
                to = $('#select-to-inventory-internal-bar-report').val();
                loadDataMaterial($('#table-bar-inventory-internal-report'), 2, from, to);
                break;
        }
    })



    /* Set cookie */
    if (getCookieShared('inventory-internal-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('inventory-internal-user-id-' + idSession));
        tabChangeInventoryInternal = dataCookie.tab
        fromCheckDateKitchenInventory = dataCookie.fromKitchen
        toCheckDateKitchenInventory = dataCookie.toKitchen
        fromCheckDateBarInventory = dataCookie.fromBar
        toCheckDateBarInventory = dataCookie.toBar
        if(!($('.select-branch').val())) {
            await updateSessionBrandNew($('.select-brand'));
        }else {
            dataInventory();
        }
    } else {
        if(!($('.select-branch').val())) {
            await updateSessionBrandNew($('.select-brand'));
        }else {
            loadData();
        }
    }
    $('#div-checklist-inventory-internal-report').on('change', '.select-brand, .select-branch', function () {
        dataExcelInventoryInternalReport = [];
        dataExcelInventoryInternalBarReport=[];
    })
});

async function loadData() {
    await dataInventory();
    loadDataMaterial($('#table-kitchen-inventory-internal-report'), 1, $('#select-from-inventory-internal-kitchen-report').val(), $('#select-to-inventory-internal-kitchen-report').val());
}

/* Set cookie */
function updateCookieInventoryInternalData() {
    saveCookieShared('inventory-internal-user-id-' + idSession, JSON.stringify({
        'tab': tabChangeInventoryInternal,
        'fromBar': fromCheckDateBarInventory,
        'toBar': toCheckDateBarInventory,
        'fromKitchen': fromCheckDateKitchenInventory,
        'toKitchen': toCheckDateKitchenInventory
    }))
}

/* End cookie */

async function dataInventory() {
    let branch = $(".select-branch").val(),
        method = 'get',
        url = 'inventory-internal-report.inventory',
        params = {
            branch: branch,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#table-kitchen-inventory-internal-report"),
        $("#table-bar-inventory-internal-report"),
        $("#select-from-inventory-internal-kitchen-report"),
        $("#select-to-inventory-internal-kitchen-report"),
    ]);
    inventoryInternalKitchen = res.data[0];
    inventoryInternalBar = res.data[1];


    await $('#select-from-inventory-internal-kitchen-report').html(inventoryInternalKitchen);
    await $('#select-to-inventory-internal-kitchen-report').html(inventoryInternalKitchen);

    checkHasInSelect(fromCheckDateKitchenInventory, $('#select-from-inventory-internal-kitchen-report'))
    checkHasInSelect(toCheckDateKitchenInventory, $('#select-to-inventory-internal-kitchen-report'))


    await $('#select-from-inventory-internal-bar-report').html(inventoryInternalBar);
    await $('#select-to-inventory-internal-bar-report').html(inventoryInternalBar);

    checkHasInSelect(fromCheckDateBarInventory, $('#select-from-inventory-internal-bar-report'))
    checkHasInSelect(toCheckDateBarInventory, $('#select-to-inventory-internal-bar-report'))

    $('#tabs-form-inventory-internal .nav-link[data-id="' + tabChangeInventoryInternal + '"]').click();

}

async function loadDataMaterial(id, inventory, from, to) {
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        method = 'get',
        url = 'inventory-internal-report.data',
        params = {
            brand: brand,
            branch: branch,
            inventory: inventory,
            from: from,
            to: to,
        },
        data = null;
    if (from === '' || to === '') {
        dataTableMaterialReport(id, []);
        $('#total-record-kitchen').text(0);
        $('#total-quantity-open-kitchen').text(0)
        $('#total-quantity-import-kitchen').text(0);
        $('#total-quantity-export-kitchen').text(0);
        $('#total-quantity-cancel-kitchen').text(0);
        $('#total-quantity-wastage-kitchen').text(0);
        $('#total-quantity-after-kitchen').text(0);
        $('#total-quantity-diff-kitchen').text(0);
        $('#total-quantity-check-kitchen').text(0);
    } else {
        let res = await axiosTemplate(method, url, params, data, [
            $('#table-kitchen-inventory-internal-report'),
            $('#table-bar-inventory-internal-report')
        ]);
        dataTableMaterialReport(id, res.data[0].original.data);
        if(inventory === 1) {
            dataExcelInventoryInternalReport = res.data[2].data;
        }else {
            dataExcelInventoryInternalBarReport = res.data[2].data;
        }
        switch (inventory) {
            case 1:
                $('#total-record-kitchen').text(res.data[0].original.recordsTotal);
                $('#total-quantity-open-kitchen').text(res.data[1].total_opening_quantity)
                $('#total-quantity-import-kitchen').text(res.data[1].total_receive_quantity);
                $('#total-quantity-export-kitchen').text(res.data[1].total_food_recipe_quantity);
                $('#total-quantity-cancel-kitchen').text(res.data[1].total_cancel_quantity);
                $('#total-quantity-wastage-kitchen').text(res.data[1].total_wastage_allow_quantity);
                $('#total-quantity-after-kitchen').text(res.data[1].total_system_last_quantity);
                $('#total-quantity-check-kitchen').text(res.data[1].total_confirm_quantity);
                $('#total-quantity-diff-kitchen').text(res.data[1].total_difference_quantity);
                break;
            case 2:
                $('#total-record-bar').text(res.data[0].original.recordsTotal);
                $('#total-quantity-open-bar').text(res.data[1].total_opening_quantity);
                $('#total-quantity-import-bar').text(res.data[1].total_receive_quantity);
                $('#total-quantity-export-bar').text(res.data[1].total_food_recipe_quantity);
                $('#total-quantity-cancel-bar').text(res.data[1].total_cancel_quantity);
                $('#total-quantity-wastage-bar').text(res.data[1].total_wastage_allow_quantity);
                $('#total-quantity-after-bar').text(res.data[1].total_system_last_quantity);
                $('#total-quantity-check-bar').text(res.data[1].total_confirm_quantity);
                $('#total-quantity-diff-bar').text(res.data[1].total_difference_quantity);
                break;
        }
        // Kitchen
        totalInventoryInternalKitchenOpenAmount = res.data[1].total_opening_quantity;
        totalInventoryInternalKitchenImportAmount = res.data[1].total_receive_quantity;
        totalInventoryInternalKitchenExportAmount = res.data[1].total_food_recipe_quantity;
        totalInventoryInternalKitchenCancelAmount = res.data[1].total_cancel_quantity;
        totalInventoryInternalKitchenWastageAmount = res.data[1].total_wastage_allow_quantity;
        totalInventoryInternalKitchenAfterAmount = res.data[1].total_system_last_quantity;
        totalInventoryInternalKitchenCheckAmount = res.data[1].total_confirm_quantity;
        totalInventoryInternalKitchenDiffAmount = res.data[1].total_difference_quantity;
        // Bar
        totalInventoryInternalBarOpenAmount = res.data[1].total_opening_quantity;
        totalInventoryInternalBarImportAmount = res.data[1].total_receive_quantity;
        totalInventoryInternalBarExportAmount = res.data[1].total_food_recipe_quantity;
        totalInventoryInternalBarCancelAmount = res.data[1].total_cancel_quantity;
        totalInventoryInternalBarWastageAmount = res.data[1].total_wastage_allow_quantity;
        totalInventoryInternalBarAfterAmount = res.data[1].total_system_last_quantity;
        totalInventoryInternalBarCheckAmount = res.data[1].total_confirm_quantity;
        totalInventoryInternalBarDiffAmount = res.data[1].total_difference_quantity;
    }
}

async function dataTableMaterialReport(id, data) {
    let fixed_left = 2,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', class: 'text-left'},
            {data: 'material_category_name', name: 'material_category_name', class: 'text-left'},
            {data: 'opening_quantity', name: 'opening_quantity', class: 'text-right'},
            {data: 'receive_quantity', name: 'receive_quantity', class: 'text-right'},
            {data: 'food_recipe_quantity', name: 'food_recipe_quantity', class: 'text-right'},
            {data: 'cancel_quantity', name: 'cancel_quantity', class: 'text-right'},
            {data: 'wastage_allow_quantity', name: 'wastage_allow_quantity', class: 'text-right'},
            {data: 'system_last_quantity', name: 'system_last_quantity', class: 'text-right'},
            {data: 'confirm_quantity', name: 'confirm_quantity', class: 'text-right'},
            {data: 'difference_quantity', name: 'difference_quantity', class: 'text-right'},
            {data: 'keysearch', class: 'd-none'},
        ],
        option = [
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print',
                'class': 'seemt-btn-hover-blue',
                'function': 'exportExcelInventoryInternalReport',
            }
        ];
    tableInventoryInternalReport = await DatatableTemplateNew(id, data, column, vh_of_table, fixed_left, fixed_right, option);

    $(document).on('input paste', '#table-kitchen-inventory-internal-report_filter', function () {
        $('#total-record-kitchen').text(tableInventoryInternalReport.rows({'search': 'applied'}).count())
        let totalTableKitchen = searchUpdateTotal(tableInventoryInternalReport)
        $('#total-quantity-before-kitchen').text(formatNumber(totalTableKitchen[0]));
        $('#total-quantity-import-kitchen').text(formatNumber(totalTableKitchen[1]));
        $('#total-quantity-export-kitchen').text(formatNumber(totalTableKitchen[2]));
        $('#total-quantity-cancel-kitchen').text(formatNumber(totalTableKitchen[3]));
        $('#total-quantity-wastage-kitchen').text(formatNumber(totalTableKitchen[4]));
        $('#total-quantity-after-kitchen').text(formatNumber(totalTableKitchen[5]));
        $('#total-quantity-check-kitchen').text(formatNumber(totalTableKitchen[6]));
        $('#total-quantity-diff-kitchen').text(formatNumber(totalTableKitchen[7]));


    })

    $(document).on('input paste', '#table-bar-inventory-internal-report_filter', function () {
        $('#total-record-bar').text(tableInventoryInternalReport.rows({'search': 'applied'}).count())
        let totalTableBar = searchUpdateTotal(tableInventoryInternalReport)
        $('#total-quantity-before-bar').text(formatNumber(totalTableBar[0]));
        $('#total-quantity-import-bar').text(formatNumber(totalTableBar[1]));
        $('#total-quantity-export-bar').text(formatNumber(totalTableBar[2]));
        $('#total-quantity-cancel-bar').text(formatNumber(totalTableBar[3]));
        $('#total-quantity-wastage-bar').text(formatNumber(totalTableBar[4]));
        $('#total-quantity-after-bar').text(formatNumber(totalTableBar[5]));
        $('#total-quantity-check-bar').text(formatNumber(totalTableBar[6]));
        $('#total-quantity-diff-bar').text(formatNumber(totalTableBar[7]));
    })
}

function searchUpdateTotal(datatable) {
    let totalQuantityOpenKitchen = 0,
        totalQuantityImportKitchen = 0,
        totalQuantityExportKitchen = 0,
        totalQuantityCancelKitchen = 0,
        totalQuantityWastageKitchen = 0,
        totalQuantityAfterKitchen = 0,
        totalQuantityCheckKitchen = 0,
        totalQuantityDiffKitchen = 0
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node())
        totalQuantityOpenKitchen += removeformatNumber(row.find('td:eq(3)').text())
        totalQuantityImportKitchen += removeformatNumber(row.find('td:eq(4)').text())
        totalQuantityExportKitchen += removeformatNumber(row.find('td:eq(5)').text())
        totalQuantityCancelKitchen += removeformatNumber(row.find('td:eq(6)').text())
        totalQuantityWastageKitchen += removeformatNumber(row.find('td:eq(7)').text())
        totalQuantityAfterKitchen += removeformatNumber(row.find('td:eq(8)').text())
        totalQuantityCheckKitchen += removeformatNumber(row.find('td:eq(9)').text())
        totalQuantityDiffKitchen += removeformatNumber(row.find('td:eq(10)').text())
    })
    return [totalQuantityOpenKitchen,
        totalQuantityImportKitchen,
        totalQuantityExportKitchen,
        totalQuantityCancelKitchen,
        totalQuantityWastageKitchen,
        totalQuantityAfterKitchen,
        totalQuantityCheckKitchen,
        totalQuantityDiffKitchen]
}
