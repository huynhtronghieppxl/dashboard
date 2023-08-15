let idEmployeeCreateDetailSupplier;

function openDetailRequestSupplierOrder(id, branch, brand, r = null) {
    $('#modal-detail-request-supplier-order').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailRequestSupplierOrder();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailRequestSupplierOrder();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailRequestSupplierOrder();
        });
    });
    dataDetailRequestSupplierOrder(id, branch, brand, r);
    $('#employee-detail-request-supplier-order').on('click', function () {
        openModalInfoEmployeeManage(idEmployeeCreateDetailSupplier);
    })
}

async function dataDetailRequestSupplierOrder(id, branch, brand, r) {
    let method = 'get',
        url = 'supplier-order.data-detail-request',
        params = {brand: brand, branch: branch, id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-request-supplier-order'),
        $('#box-list-detail-request-supplier-order'),
    ]);
    if(res.data[0].status == 5){
        $('#div-reason-detail-request-supplier-order').removeClass('d-none');
    }else{
        $('#div-reason-detail-request-supplier-order').addClass('d-none');
    }
    idEmployeeCreateDetailSupplier = res.data[0].employee_create_id;
    drawTableDetailRequestSupplierOrder(res.data[1].original.data);
    $('#branch-detail-request-supplier-order').text(res.data[0].branch_name);
    $('#reason-detail-request-supplier-order').text(res.data[0].reason);
    $('#inventory-detail-request-supplier-order').text(r?.parents('tr')?.find('td:eq(2)')?.text());
    $('#date-detail-request-supplier-order').text(res.data[0].date);
    $('#image-supplier-detail-request-order-supplier-order').text(res.data[0].date);
    $('#employee-detail-request-supplier-order').text(res.data[0].employee_create_full_name);
    $('#image-employee-detail-request-order-supplier-order').attr('src',res.data[0].employee_create_avatar);
    $('#create-detail-request-supplier-order').text(res.data[0].created_at);
    $('#total-price-detail-request-supplier-order').text(res.data[2]);
    $('#status-detail-order-request-manage').html(res.data[0].paid_status);
}

function drawTableDetailRequestSupplierOrder(data) {
    let id = $('#table-material-detail-request-supplier-order'),
        fixed_left = 2,
        fixed_right = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'system_last_quantity', name: 'system_last_quantity', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'total_price', name: 'total_price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    DatatableTemplateNew(id, data, column, '40vh', fixed_left, fixed_right);
}

function closeModalDetailRequestSupplierOrder() {
    $('#modal-detail-request-supplier-order').modal('hide');
    shortcut.remove('ESC');
    resetModalDetailRequestSupplierOrder();
}

function resetModalDetailRequestSupplierOrder() {
    $('#branch-detail-request-supplier-order').text('---');
    $('#inventory-detail-request-supplier-order').text('---');
    $('#employee-detail-request-supplier-order').text('---');
    $('#date-detail-request-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#create-detail-request-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#total-price-detail-request-supplier-order').text('0');
}
