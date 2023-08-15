let dataTableDetailCancelInventoryWarehouse = '', idEmployeeCancelInventory = 0;
function openDetailCancelInventoryWarehouse(r) {
    $('#modal-detail-cancel-inventory-warehouse').modal('show');
    $('#employee-detail-cancel-inventory-warehouse').on('click', function (){
        openModalInfoEmployeeManage(idEmployeeCancelInventory);
    })
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailInInventoryWarehouse();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailInInventoryManage();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailInInventoryManage();
        });
    });
    dataDetailCancelInventoryWarehouse(r.data('id'), r.data('branch'));
}

async function dataDetailCancelInventoryWarehouse(id, branch) {
    let method = 'get',
        url = 'cancel-inventory-warehouse.detail',
        params = {
            id: id,
            branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-cancel-inventory-warehouse'),
        $('#box-detail-cancel-inventory-warehouse')
    ]);
    idEmployeeCancelInventory = (res.data[2].data.employee.id);
    $('#branch-detail-cancel-inventory-warehouse').text(res.data[1].branch);
    $('#code-detail-cancel-inventory-warehouse').text(res.data[1].code);
    $('#inventory-detail-cancel-inventory-warehouse').text(res.data[1].inventory);
    $('#date-detail-cancel-inventory-warehouse').text(res.data[1].delivery);
    $('#employee-detail-cancel-inventory-warehouse').text(res.data[1].employee);
    $('#image-employee-detail-cancel-inventory-warehouse').attr('src', res.data[1].employee_avatar);
    $('#create-detail-cancel-inventory-warehouse').text(res.data[1].create);

    $('#note-detail-cancel-inventory-warehouse').text(!res.data[1].cancel_reason ? '---' : res.data[1].cancel_reason);
    let id_table1 = $('#table-material-detail-cancel-inventory-warehouse'),
        scroll_Y = '50vh',
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'user_input_quantity', name: 'user_input_quantity', className: 'text-center'},
            {data: 'unit_price', name: 'unit_price', className: 'text-center'},
            {data: 'note', name: 'note', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    dataTableDetailCancelInventoryWarehouse = await DatatableTemplateNew(id_table1, res.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right);
}

function closeModalDetailInInventoryWarehouse() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openCreateCancelInventoryWarehouse();
    });
    $('#modal-detail-cancel-inventory-warehouse').modal('hide');
    resetModalDetailInInventoryWarehouse();
}

function resetModalDetailInInventoryWarehouse() {
    $('#branch-detail-cancel-inventory-warehouse').text('---');
    $('#code-detail-cancel-inventory-warehouse').text('---');
    $('#supplier-detail-cancel-inventory-warehouse').text('---');
    $('#inventory-detail-cancel-inventory-warehouse').text('---');
    $('#employee-detail-cancel-inventory-warehouse').text('---');
    $('#date-detail-cancel-inventory-warehouse').text(moment().format('DD/MM/YYYY'));
    $('#create-detail-cancel-inventory-warehouse').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#note-detail-cancel-inventory-warehouse').text('---');
    dataTableDetailCancelInventoryWarehouse.clear().draw(false);
}
