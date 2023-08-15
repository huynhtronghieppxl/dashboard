function openModalDetailSupplierData(id) {
    $('#modal-detail-supplier-data').modal('show');
    shortcut.add('ESC', function () {
        closeModalDetailSupplierData();
    });
    dataDetailSupplierData(id);
}

async function dataDetailSupplierData(id) {
    let method = 'get',
        url = 'restaurant-supplier-data.detail',
        branch = $('#change_branch').val(),
        params = {
            supplier: id, branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#name-detail-supplier-data').text(res.data[0].name);
    $('#prefix-detail-supplier-data').text(res.data[0].prefix);
    $('#phone-detail-supplier-data').text(res.data[0].phone);
    $('#address-detail-supplier-data').text(res.data[0].address);
    $('#email-detail-supplier-data').text(res.data[0].email);
    $('#tax-detail-supplier-data').text(res.data[0].tax_code);
    $('#website-detail-supplier-data').text(res.data[0].website);
    $('#description-detail-supplier-data').text(res.data[0].description);
    $('#status-detail-supplier-data').html(res.data[0].status);
    dataTotalDetailSupplierData(res.data[4]);
    dataTableContactDetailSupplierData(res.data[1].original.data);
    dataTableLiabilitiesDetailSupplierData(res.data[2].original.data);
    dataTableMaterialDetailSupplierData(res.data[3].original.data);
}

function dataTableContactDetailSupplierData(data) {
    let id = $('#table-contact-detail-supplier-data'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'phone', name: 'phone', className: 'text-center'},
            {data: 'email', name: 'email', className: 'text-center'},
            {data: 'role_name', name: 'role_name', className: 'text-center'}
        ];
    DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

function dataTableLiabilitiesDetailSupplierData(data) {
    let id = $('#table-liabilities-detail-supplier-data'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'employee.name', name: 'employee.name', className: 'text-center'},
            {data: 'delivery_date', name: 'delivery_date', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

function dataTableMaterialDetailSupplierData(data) {
    let id = $('#table-material-detail-supplier-data'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'material_category_name', name: 'material_category_name', className: 'text-center'},
            {data: 'material_unit_full_name', name: 'material_unit_full_name', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

function dataTotalDetailSupplierData(data) {
    $('#total-record-contact-supplier-data').text(data.total_record_contact);
    $('#total-record-liabilities-supplier-data').text(data.total_record_liabilities);
    $('#total-record-material-supplier-data').text(data.total_record_material);
    $('#total-liabilities-supplier-data').text(data.total_liabilities);
}

function closeModalDetailSupplierData() {
    $('#modal-detail-supplier-data').modal('hide')
    resetModalDetailSupplierData();
}

function resetModalDetailSupplierData() {
    $('#name-detail-supplier-data').text('---');
    $('#prefix-detail-supplier-data').text('---');
    $('#phone-detail-supplier-data').text('---');
    $('#address-detail-supplier-data').text('---');
    $('#email-detail-supplier-data').text('---');
    $('#tax-detail-supplier-data').text('---');
    $('#website-detail-supplier-data').text('---');
    $('#description-detail-supplier-data').text('---');
}
