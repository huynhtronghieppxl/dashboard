let tableSupplierInventory, dataExcelInventorySupplierReport, fromDateInventorySupplierReport = $('#from-date-inventory-supplier-report').val(),
    toDateInventorySupplierReport = $('#to-date-inventory-supplier-report').val(),
    selectSupInventorySupplierReport, selectInvInventorySupplierReport;
$(function () {
    dateTimePickerFromToDateTemplate2($('#from-date-inventory-supplier-report') , $('#to-date-inventory-supplier-report'));
    if (getCookieShared('inventory-supplier-report-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('inventory-supplier-report-id-' + idSession));
        selectSupInventorySupplierReport = dataCookie.select;
        selectInvInventorySupplierReport = dataCookie.select;
        fromDateInventorySupplierReport = dataCookie.from;
        toDateInventorySupplierReport = dataCookie.to;
        $('#from-date-inventory-supplier-report').val(fromDateInventorySupplierReport);
        $('#to-date-inventory-supplier-report').val(toDateInventorySupplierReport);
        dateTimePickerFromMaxToDate($('#from-date-inventory-supplier-report') , $('#to-date-inventory-supplier-report'));

    }
    $('#from-date-inventory-supplier-report').on('dp.change', function () {
        fromDateInventorySupplierReport = $(this).val();
        $('#from-date-inventory-supplier-report').val($(this).val());
    });
    $('#to-date-inventory-supplier-report').on('dp.change', function () {
        toDateInventorySupplierReport = $(this).val();
        $('#to-date-inventory-supplier-report').val($(this).val());
    });
    $('#search-btn-inventory-supplier-report').on('click', function () {
        if(!checkDateTimePicker($(this))){
            return false;
        }
        fromDateInventorySupplierReport = $('.from-date-inventory-supplier-report').val();
        toDateInventorySupplierReport = $('.to-date-inventory-supplier-report').val();
        validateDateTemplate($('.from-date-inventory-supplier-report'), $('.to-date-inventory-supplier-report'), loadDataMaterial);
    });
    $('#select-supplier-inventory-supplier-report').on('select2:select', function () {
        $('#select-supplier-inventory-supplier-report').val($(this).val()).trigger('change.select2');
        selectSupInventorySupplierReport = $(this).val();
        updateCookieInventorySupplierReport();
        loadDataMaterial();
    });
    $('#select-inventory-inventory-supplier-report').on('select2:select', function () {
        $('#select-inventory-inventory-supplier-report').val($(this).val()).trigger('change.select2');
        selectInvInventorySupplierReport = $(this).val();
        updateCookieInventorySupplierReport();
        loadDataMaterial();
    });
    loadData();
});

function updateCookieInventorySupplierReport() {
    saveCookieShared('inventory-supplier-report-id-' + idSession, JSON.stringify({
        'selectSup': selectSupInventorySupplierReport,
        'selectInv': selectInvInventorySupplierReport,
        'from': fromDateInventorySupplierReport,
        'to':toDateInventorySupplierReport,
    }))
}

function loadData() {
    loadDataSupplier();
    loadDataMaterial();
}

async function loadDataSupplier() {
    let method = 'get',
        url = 'inventory-supplier-report.supplier',
        branch = $('.select-branch').val(),
        brand = $('.select-brand').val(),
        from = $('#from-date-inventory-supplier-report').val(),
        to = $('#to-date-inventory-supplier-report').val(),
        params = {brand: brand, branch: branch, from: from, to: to},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#select-supplier-inventory-supplier-report').html(res.data[0]);
    checkHasInSelect(selectSupInventorySupplierReport, $('#select-supplier-inventory-supplier-report'));
    selectSupInventorySupplierReport = $('#select-supplier-inventory-supplier-report').val();
    $('#select-supplier-inventory-supplier-report').val(selectSupInventorySupplierReport).trigger('change.select2');
}

async function loadDataMaterial() {
    let method = 'get',
        url = 'inventory-supplier-report.data',
        branch = $('.select-branch').val(),
        supplier = $('#select-supplier-inventory-supplier-report').val(),
        inventory = $('#select-inventory-inventory-supplier-report').val(),
        from = $('#from-date-inventory-supplier-report').val(),
        to = $('#to-date-inventory-supplier-report').val(),
        params = {branch: branch, from: from, to: to, supplier: supplier, inventory: inventory},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-inventory-supplier-report')]);
    dataTableInventorySupplierReport(res.data[0].original.data)
    totalAmountInventorySupplier = res.data[1];
    $('#total-amount-inventory-supplier').text(totalAmountInventorySupplier);
    dataExcelInventorySupplierReport = res.data[2].data;
    checkHasInSelect(selectInvInventorySupplierReport, $('#select-inventory-inventory-supplier-report'));
    selectInvInventorySupplierReport = $('#select-inventory-inventory-supplier-report').val();
}

async function dataTableInventorySupplierReport(data) {
    let id = $('#table-inventory-supplier-report'),
        fixed_left = 2,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-left', width: '5%'},
            {data: 'name', name: 'name', class: 'text-left'},
            {data: 'material_category_type_name', name: 'material_category_type_name', class: 'text-left'},
            {data: 'inventory', name: 'category', class: 'text-left'},
            {data: 'accept_quantity', name: 'accept_quantity', class: 'text-right'},
            {data: 'small_accept_quantity', name: 'small_accept_quantity', class: 'text-right'},
            {data: 'total_price_reality', name: 'total_price_reality', class: 'text-right'},
            {data: 'action', name: 'action', class: 'text-center'},
            {data: 'key_search', name: 'key_search', class: 'd-none'},
        ],
        option = [
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print',
                'class': 'seemt-btn-hover-blue',
                'function': 'exportExcelInventorySupplierReport',
            }
        ]
    tableSupplierInventory = await  DatatableTemplateNew(id, data, column, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste keyup keydown', '#table-inventory-supplier-report_filter', async function () {
        let totalAmount = 0;
        await tableSupplierInventory.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalAmount += removeformatNumber(row.find('td:eq(6)').text());
        })
        $('#total-amount-inventory-supplier').text(formatNumber(totalAmount));
    })
}
