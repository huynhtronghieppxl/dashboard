let idSupplierReturnSupplierOrder, idEmployeeReturnSupplierOrder;
function openModalDetailReturnOrder(id) {
    $('#modal-detail-return-order').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailReturnOrder();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailReturnOrder();
        });
    })
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailReturnOrder();
        });
    });
    $('#employee-return-detail-return-order-supplier-order').unbind('click').on('click', function (){
        openModalInfoEmployeeManage(idEmployeeReturnSupplierOrder);
    })
    dataDetail(id);
}

async function dataDetail(id) {
    let method = 'get',
        url = 'supplier-order.detail-return',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-return-order'),
        $('#box-list-detail-return-order-manage')
    ]);
    idSupplierReturnSupplierOrder = res.data[1].data.supplier_id
    idEmployeeReturnSupplierOrder = res.data[1].data.employee_created_id
    $('#branch-detail-return-order-supplier-order').text(res.data[1].data.branch_name);
    $('#code-detail-return-order-supplier-order').text(res.data[1].data.code);
    $('#supplier-detail-return-order-supplier-order').text(res.data[1].data.supplier_name);
    $('#image-supplier-detail-return-order-supplier-order').attr('src',res.data[1].data.supplier_avatar);
    $('#amount-detail-return-order-supplier-order').text(formatNumber(res.data[1].data.amount));
    $('#discount-detail-return-order-supplier-order').text(formatNumber(res.data[1].data.discount_amount));
    $('#vat-detail-return-order-supplier-order').text(formatNumber(res.data[1].data.vat_amount));
    $('#total-amount-detail-return-order-supplier-order').text(formatNumber(res.data[1].data.total_amount));
    $('#employee-return-detail-return-order-supplier-order').text(res.data[1].data.employee_created_full_name);
    $('#image-employee-detail-return-order-supplier-order').attr('src', res.data[1].data.employee_created_avatar)
    $('#discount-percent-detail-return-order-supplier-order').text('('+res.data[1].data.discount_percent+ '%)');
    $('#vat-percent-detail-return-order-supplier-order').text('('+res.data[1].data.vat + '%)');
    $('#date-return-detail-return-order-supplier-order').text(res.data[1].data.created_at);
    $('#reason-detail-return-order-supplier-order').text(res.data[1].data.note);
    tableDetailReturnOrder(res.data[0].original.data);
}

function tableDetailReturnOrder(data) {
    let id = $('#table-material-detail-return-order'),
        scroll_Y = '50vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'total_price', name: 'total_price', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

function closeModalDetailReturnOrder() {
    $('#modal-detail-return-order').modal('hide');
    resetModalDetailReturnOrder();
}

function resetModalDetailReturnOrder() {
    $('#branch-detail-return-order-supplier-order').text('---');
    $('#code-detail-return-order-supplier-order').text('---');
    $('#supplier-detail-return-order-supplier-order').text('---');
    $('#amount-detail-return-order-supplier-order').text(0);
    $('#discount-detail-return-order-supplier-order').text(0);
    $('#vat-detail-return-order-supplier-order').text(0);
    $('#total-amount-detail-return-order-supplier-order').text(0);
    $('#employee-return-detail-return-order-supplier-order').text('---');
    $('#date-return-detail-return-order-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#reason-detail-return-order-supplier-order').text('---');
}
