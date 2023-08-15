let idEmployeeCreateDetailRequest, tableMaterialOrderRequestWarehouse;

function openDetailRequestSupplierOrder(id, branch, brand) {
    $('#modal-detail-request-goods-purchase-warehouse').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailOrderRequestWarehouse();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailOrderRequestWarehouse();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailOrderRequestWarehouse();
        });
    });
    dataDetailOrderRequestWarehouse(id, branch, brand);
    $('#employee-detail-request-goods-purchase-warehouse').on('click', function () {
        openModalInfoEmployeeManage(idEmployeeCreateDetailRequest);
    })
}

async function dataDetailOrderRequestWarehouse(id, branch, brand) {
    let method = 'get',
        url = 'goods-purchase.detail-order-request',
        params = {brand: brand, branch: branch, id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-request-goods-purchase-warehouse'),
        $('#box-list-detail-request-goods-purchase-warehouse'),
    ]);
    if(res.data[0].status == 5){
        $('#div-reason-detail-request-goods-purchase-warehouse').removeClass('d-none');
    }else{
        $('#div-reason-detail-request-goods-purchase-warehouse').addClass('d-none');
    }
    idEmployeeCreateDetailRequest = res.data[0].employee_created_id;
    drawTableDetailRequestSupplierOrder(res.data[1].original.data);
    $('#branch-detail-request-goods-purchase-warehouse').text(res.data[0].branch_name);
    $('#inventory-detail-request-goods-purchase-warehouse').text(res.data[0].material_category_type_parent_id);
    $('#employee-detail-request-goods-purchase-warehouse').text(res.data[0].employee_created_full_name);
    $('#image-employee-detail-request-order-supplier-order').attr('src',res.data[0].employee_created_avatar);
    $('#create-detail-request-goods-purchase-warehouse').text(res.data[0].created_at);
    $('#total-price-detail-request-goods-purchase-warehouse').text(res.data[2]);
    // $('#status-detail-order-request-manage').html(res.data[0].paid_status);
}

function drawTableDetailRequestSupplierOrder(data) {
    let id = $('#table-material-detail-request-goods-purchase-warehouse'),
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
    tableMaterialOrderRequestWarehouse = DatatableTemplateNew(id, data, column, '40vh', fixed_left, fixed_right);
}

function closeModalDetailOrderRequestWarehouse() {
    $('#modal-detail-request-goods-purchase-warehouse').modal('hide');
    shortcut.remove('ESC');
    resetModalDetailOrderRequestWarehouse();
}

function resetModalDetailOrderRequestWarehouse() {
    $('#branch-detail-request-goods-purchase-warehouse').text('---');
    $('#inventory-detail-request-goods-purchase-warehouse').text('---');
    $('#employee-detail-request-goods-purchase-warehouse').text('---');
    $('#create-detail-request-goods-purchase-warehouse').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#total-price-detail-request-goods-purchase-warehouse').text('0');
    tableMaterialOrderRequestWarehouse.draw(false);
}
