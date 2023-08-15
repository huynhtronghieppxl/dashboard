let dataTableDetailReturnInventoryInternalManage , idEmployeeCreateReturnInventorySupplier;
$(function(){
    $('#employee-detail-return-inventory-internal-manage').on('click', function () {
        openModalInfoEmployeeManage(idEmployeeCreateReturnInventorySupplier);
    })
})
function openDetailReturnInventoryInternalManage(id, branch) {
    $('#modal-detail-return-inventory-internal-manage').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalDetailReturnInventoryInternalManage();
    });
    $('#modal-detail-return-inventory-internal-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailReturnInventoryInternalManage();
        });
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailReturnInventoryInternalManage();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailReturnInventoryInternalManage();
        });
    });
    dataDetailReturnInventoryInternalManage(id, branch);
}

async function dataDetailReturnInventoryInternalManage(id, branch) {
    let method = 'get',
        url = 'return-inventory-internal-manage.detail',
        params = {
            id: id,
            branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-return-inventory-internal-manage'),
        $('#box-list-detail-return-inventory-internal-manage')
    ]);
    $('#employee-detail-return-inventory-internal-manage').text(res.data[0].employee_full_name);
    idEmployeeCreateReturnInventorySupplier = res.data[0].employee_id;
    $('#image-employee-detail-return-inventory-internal-manage').attr('src', res.data[0].employee_avatar);
    $('#date-detail-return-inventory-internal-manage').text(res.data[0].delivery_date);
    $('#note-detail-return-inventory-internal-manage').text(res.data[0].note);
    $('#branch-detail-return-inventory-internal-manage').text(res.data[0].branch_name);
    $('#inventory-detail-return-inventory-internal-manage').text(res.data[0].inventory);
    $('#code-detail-return-inventory-manage').text(res.data[0].code);
    $('#create-detail-cancel-inventory-manage').text(res.data[0].created_at);
    let tableMaterialDetailReturnInventoryInternalManage = $('#table-material-detail-return-inventory-internal-manage'),
        scroll_Y = '40vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'user_input_quantity', name: 'user_input_quantity', className: 'text-center'},
            {data: 'unit_price', name: 'unit_price', className: 'text-right'},
            {data: 'note', name: 'note', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    dataTableDetailReturnInventoryInternalManage = await DatatableTemplateNew(tableMaterialDetailReturnInventoryInternalManage, res.data[1].original.data, columns, scroll_Y, fixed_left, fixed_right);
}

function closeModalDetailReturnInventoryInternalManage() {
    $('#modal-detail-return-inventory-internal-manage').modal('hide');
    resetModalDetailReturnInventoryInternalManage()
}
function resetModalDetailReturnInventoryInternalManage(){
    $('#employee-detail-return-inventory-internal-manage').text('---');
    $('#date-detail-return-inventory-internal-manage').text('---');
    $('#note-detail-return-inventory-internal-manage').text('---');
    $('#branch-detail-return-inventory-internal-manage').text('---');
    dataTableDetailReturnInventoryInternalManage.clear().draw(false)
}
