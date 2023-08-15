function openModalDetailSupplierDebtReport(r) {
    $('#modal-detail-supplier-debt-dashboard-report').modal('show');
    shortcut.add('ESC', function () {
        closeModalDetailSupplierDebtReport();
    });
    loadDetailSupplierDebtData(r)
}

async function loadDetailSupplierDebtData(r) {
    let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
        branch = $('#change_branch').val(),
        supplier = r.data('id'),
        type = r.data('type'),
        date_string = $('#select-type-debt-report').find(':selected').data('time'),
        method = 'get',
        url = 'branch-dashboard.data-detail-supplier-debt-report',
        params = {brand: brand,
            branch: branch,
            type: type,
            id: supplier,
            date_string: date_string,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$("#table-detail-supplier-debt-dashboard-report")]);
    // $(".empty-datatable-custom").remove()
    tableDetailSupplierDebtReport(res.data[0].original.data);
}

async function tableDetailSupplierDebtReport(data) {
    let scroll_Y = '40vh';
    let fixed_left = 0;
    let fixed_right = 0;
    let id = $('#table-detail-supplier-debt-dashboard-report');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'supplier_orders', name: 'supplier_orders', className: 'text-center'},
        {data: 'note', name: 'note', className: 'text-center'},
        {data: 'debt_amount', name: 'debt_amount', className: 'text-center'},
        {data: 'paid_amount', name: 'paid_amount', className: 'text-center'},
        {data: 'owed_amount', name: 'owed_amount', className: 'text-center'},
        {data: 'keysearch', name: 'keysearch', className: 'd-none'},
    ];
    await DatatableTemplateNew(id, data, column, scroll_Y, fixed_left, fixed_right, []);
}

function closeModalDetailSupplierDebtReport() {
    $('#modal-detail-supplier-debt-dashboard-report').modal('hide');
}
