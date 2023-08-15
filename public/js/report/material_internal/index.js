let DataTableMaterialInternalKitchen = null,
    DataTableMaterialInternalBar = null,
    from = $('.from-date-material-internal-report').val(), to = $('.to-date-material-internal-report').val(), typeTabMaterialInternal = 1;
let dataExcelMaterialMaterialInternalReport, dataExcelBarMaterialInternalReport;
$(async function () {
    if(getCookieShared('material-internal-report-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('material-internal-report-user-id-' + idSession));
        typeTabMaterialInternal = dataCookie.tab
        from = dataCookie.from
        to = dataCookie.to
        $('.from-date-material-internal-report').val(from)
        $('.to-date-material-internal-report').val(to)
    }

    dateTimePickerFromToDateTemplate2($('.from-date-material-internal-report'), $('.to-date-material-internal-report'))
    $('.from-date-material-internal-report').on('dp.change', function () {
        $('.from-date-material-internal-report').val($(this).val())
    })
    $('.to-date-material-internal-report').on('dp.change', function () {
        $('.to-date-material-internal-report').val($(this).val())
    })
    $('.search-btn-material-internal-report').on('click', function () {
        if(!checkDateTimePicker($(this))) return false;
        from = $('.from-date-material-internal-report').val();
        to = $('.to-date-material-internal-report').val();
        updateCookieMaterialInternal();
        loadData();

    });
    if(!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }

    $('#tabs-form-material-internal li a').on('click', function () {
        typeTabMaterialInternal = $(this).data('tab')
        updateCookieMaterialInternal();
    })
    $('#tabs-form-material-internal li a[data-tab="' + typeTabMaterialInternal + '"]').click();
});

function updateCookieMaterialInternal(){
    saveCookieShared('material-internal-report-user-id-' + idSession, JSON.stringify({
        'tab' : typeTabMaterialInternal,
        'from' : from,
        'to' : to,
    }))
}

async function loadData() {
    let branch = $(".select-branch").val(),
        from = $('.from-date-material-internal-report').val(),
        to = $('.to-date-material-internal-report').val(),
        brand = $('#restaurant-branch-id-selected span').attr('data-value'),
        method = 'get',
        url = 'material-internal-report.data',
        params = {
            brand : brand,
            branch: branch,
            from: from,
            to: to,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#table-material-material-internal-report"),$("#table-goods-material-internal-report")]);
    await dataTableMaterialReport(res);
    $('#total-record-kitchen').text(res.data[2]);
    $('#total-record-bar').text(res.data[3]);
    dataExcelMaterialMaterialInternalReport = res.data[0].original.data;
    dataExcelBarMaterialInternalReport = res.data[1].original.data;
    $('#total-confirm-system-quantity-kitchen').text(res.data[4].kitchen.total_confirm_system_amount);
    $('#total-import-quantity-kitchen').text(res.data[4].kitchen.total_import_amount);
    $('#total-export-quantity-kitchen').text(res.data[4].kitchen.total_export_amount);
    $('#total-cancel-quantity-kitchen').text(res.data[4].kitchen.total_cancel_amount);
    $('#total-return-quantity-kitchen').text(res.data[4].kitchen.total_return_amount);
    $('#total-wastage-allow-quantity-kitchen').text(res.data[4].kitchen.total_wastage_allow_amount);
    $('#total-system-last-kitchen').text(res.data[4].kitchen.total_system_last_amount);

    $('#total-confirm-system-quantity-bar').text(res.data[4].bar.total_confirm_system_amount);
    $('#total-import-quantity-bar').text(res.data[4].bar.total_import_amount);
    $('#total-export-quantity-bar').text(res.data[4].bar.total_export_amount);
    $('#total-cancel-quantity-bar').text(res.data[4].bar.total_cancel_amount);
    $('#total-return-quantity-bar').text(res.data[4].bar.total_return_amount);
    $('#total-wastage-allow-quantity-bar').text(res.data[4].bar.total_wastage_allow_amount);
    $('#total-system-last-bar').text(res.data[4].bar.total_system_last_amount);
}

async function dataTableMaterialReport(data) {
    let idMaterial = $('#table-material-material-internal-report'),
        idGoods = $('#table-goods-material-internal-report'),
        fixed_left = 2,
        fixed_right = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', class: 'text-left'},
            {data: 'confirm_system_quantity', name: 'confirm_system_quantity', class: 'text-right', width: '8%'},
            {data: 'import_quantity', name: 'import_quantity', class: 'text-right', width: '8%'},
            {data: 'export_quantity', name: 'export_quantity', class: 'text-right', width: '8%'},
            {data: 'return_quantity', name: 'return_quantity', class: 'text-right', width: '8%'},
            {data: 'cancel_quantity', name: 'cancel_quantity', class: 'text-right', width: '8%'},
            {data: 'wastage_rate', name: 'wastage_rate', class: 'text-right', width: '8%'},
            {data: 'wastage_allow_quantity', name: 'wastage_allow_quantity', class: 'text-right', width: '8%'},
            {data: 'system_last_quantity', name: 'system_last_quantity', class: 'text-right', width: '8%'},
            {data: 'action', name: 'action', class: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option =[
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print',
                'class': 'seemt-btn-hover-blue',
                'function': 'exportExcelMaterialInternalReport',
            }
        ];
    DataTableMaterialInternalKitchen = await DatatableTemplateNew(idMaterial, data.data[0].original.data, column, vh_of_table, fixed_left, fixed_right, option);
    DataTableMaterialInternalBar = await DatatableTemplateNew(idGoods, data.data[1].original.data, column, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste keyup keydown', 'input[type="search"]', async function () {
        $('#total-record-kitchen').text(DataTableMaterialInternalKitchen.rows({'search': 'applied'}).count());
        $('#total-record-bar').text(DataTableMaterialInternalBar.rows({'search': 'applied'}).count());
        if($(this).attr('aria-controls') === 'table-material-material-internal-report') {
            let listTotalMaterial = searchUpdateTotalMaterial(DataTableMaterialInternalKitchen);
            $('#total-confirm-system-quantity-kitchen').text(formatNumber(listTotalMaterial[0]));
            $('#total-import-quantity-kitchen').text(formatNumber(listTotalMaterial[1]));
            $('#total-export-quantity-kitchen').text(formatNumber(listTotalMaterial[2]));
            $('#total-cancel-quantity-kitchen').text(formatNumber(listTotalMaterial[3]));
            $('#total-return-quantity-kitchen').text(formatNumber(listTotalMaterial[4]));
            $('#total-wastage-allow-quantity-kitchen').text(formatNumber(listTotalMaterial[5]));
            $('#total-system-last-kitchen').text(formatNumber(listTotalMaterial[6]));
        }else {
            let listTotalGoods = searchUpdateTotalMaterial(DataTableMaterialInternalBar);
            $('#total-confirm-system-quantity-bar').text(formatNumber(listTotalGoods[0]));
            $('#total-import-quantity-bar').text(formatNumber(listTotalGoods[1]));
            $('#total-export-quantity-bar').text(formatNumber(listTotalGoods[2]));
            $('#total-cancel-quantity-bar').text(formatNumber(listTotalGoods[3]));
            $('#total-return-quantity-bar').text(formatNumber(listTotalGoods[4]));
            $('#total-wastage-allow-quantity-bar').text(formatNumber(listTotalGoods[5]));
            $('#total-system-last-bar').text(formatNumber(listTotalGoods[6]));
        }
    });
}

function searchUpdateTotalMaterial(datatable){
    let totalConfirmSystemQuantity = 0,
        totalImportQuantity = 0,
        totalExportQuantity = 0,
        totalCancelQuantity = 0,
        totalReturnQuantity = 0,
        totalWastageAllowQuantity = 0,
        totalSystemLast = 0;
    datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node());
        totalConfirmSystemQuantity += removeformatNumber(row.find('td:eq(2) label:first-child').text());
        totalImportQuantity += removeformatNumber(row.find('td:eq(3) label:first-child').text());
        totalExportQuantity += removeformatNumber(row.find('td:eq(4) label:first-child').text());
        totalReturnQuantity += removeformatNumber(row.find('td:eq(5) label:first-child').text());
        totalCancelQuantity += removeformatNumber(row.find('td:eq(6) label:first-child').text());
        totalWastageAllowQuantity += removeformatNumber(row.find('td:eq(8) label:first-child').text());
        totalSystemLast += removeformatNumber(row.find('td:eq(9) label:first-child').text());
    })
    return [totalConfirmSystemQuantity,
            totalImportQuantity,
            totalExportQuantity,
            totalCancelQuantity,
            totalReturnQuantity,
            totalWastageAllowQuantity,
            totalSystemLast ];
}
