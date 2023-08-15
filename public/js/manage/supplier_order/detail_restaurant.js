let dataTableDetailRestaurantSupplierOrder, idEmployeeRestaurantDetail;

$(function(){
    $('#employee-detail-restaurant-supplier-order').on('click', function () {
        openModalInfoEmployeeManage(idEmployeeRestaurantDetail);
    })
})
function openDetailRestaurantSupplierOrder(id) {
    $('#modal-detail-restaurant-supplier-order').modal('show');
    resetModalDetailRestaurantSupplierOrder()
    $('#modal-detail-restaurant-supplier-order .js-example-basic-single').select2({
        dropdownParent: $('#modal-detail-restaurant-supplier-order'),
    });
    shortcut.add('ESC', function () {
        closeModalDetailRestaurantSupplierOrder();
    });
    dataDetailRestaurantSupplierOrder(id);
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailRestaurantSupplierOrder();
        });
    })
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailRestaurantSupplierOrder();
        });
    });

}

async function dataDetailRestaurantSupplierOrder(id) {
    let method = 'get',
        url = 'supplier-order.data-detail-restaurant',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#table-material-detail-restaurant-supplier-order'),
        $('#boxlist-detail-restaurant-supplier-order'),
    ]);
    idEmployeeRestaurantDetail = res.data[0].employee_created_id;
    $('#branch-detail-restaurant-supplier-order').text(res.data[0].branch_name);
    $('#supplier-detail-restaurant-supplier-order').text(res.data[0].supplier_name);
    $('#image-supplier-detail-restaurant-supplier-order').attr('src',res.data[0].supplier_avatar);
    $('#date-detail-restaurant-supplier-order').text(res.data[0].expected_delivery_time);
    $('#employee-detail-restaurant-supplier-order').text(res.data[0].employee_created_full_name);
    $('#image-employee-detail-restaurant-supplier-order').attr('src',res.data[0].employee_created_avatar);
    $('#create-detail-restaurant-supplier-order').text(res.data[0].created_at);
    $('#total-amount-detail-restaurant-supplier-order').text(formatNumber(res.data[0].supplier_amount));
    dataTableDetailRestaurantSupplierOrder = drawTableDetailRestaurantSupplierOrder(res.data[1].original.data);

}

async function drawTableDetailRestaurantSupplierOrder(data) {
    let id = $('#table-material-detail-restaurant-supplier-order'),
        fixed_left = 2,
        fixed_right = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'total_price', name: 'total_price', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    DatatableTemplateNew(id, data, column, '40vh', fixed_left, fixed_right);
}

function closeModalDetailRestaurantSupplierOrder() {
    $('#modal-detail-restaurant-supplier-order').modal('hide');
    shortcut.remove('ESC');
    resetModalDetailRestaurantSupplierOrder();
}

function resetModalDetailRestaurantSupplierOrder() {
    $('#branch-detail-restaurant-supplier-order').text('---');
    $('#supplier-detail-restaurant-supplier-order').text('---');
    $('#employee-detail-restaurant-supplier-order').text('---');
    $('#date-detail-restaurant-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#create-detail-restaurant-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#total-amount-detail-restaurant-supplier-order').text(0);
}
