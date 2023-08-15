let idEmployeeCancelInventoryInternal;
function openDetailCancelInventoryManage(id, branch) {
    $('#modal-detail-cancel-inventory-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailCancelInventoryManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailCancelInventoryManage();
        });
    })
    $('#employee-detail-cancel-inventory-manage').on('click', function (){
        openModalInfoEmployeeManage(idEmployeeCancelInventoryInternal)
    })
    dataDetailCancelInventoryManage(id, branch);
}

async function dataDetailCancelInventoryManage(id, branch) {
    let method = 'get',
        url = 'cancel-inventory-internal-manage.detail',
        params = {
            id: id,
            branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-cancel-inventory-manage'),
        $('#box-list-detail-cancel-inventory-manage')
    ]);
    idEmployeeCancelInventoryInternal = (res.data[0].employee_id);
    $('#code-detail-cancel-inventory-manage').text(res.data[0].code);
    $('#employee-detail-cancel-inventory-manage').text(res.data[0].employee_full_name);
    $('#date-detail-cancel-inventory-manage').text(res.data[0].delivery_date);
    $('#create-detail-cancel-inventory-manage').text(res.data[0].created_at);
    $('#note-detail-cancel-inventory-manage').text(res.data[0].note);
    $('#branch-detail-cancel-inventory-manage').text(res.data[0].branch_name);
    $('#inventory-detail-cancel-inventory-manage').text(res.data[0].inventory);
    $('#image-employee-detail-cancel-inventory-manage').attr('src', res.data[3].employee_avatar);

    let tableMaterialDetailCancelInventoryManage = $('#table-material-detail-cancel-inventory-manage'),
        scroll_Y = '40vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'material_name', className: 'text-left'},
            {data: 'user_input_quantity', name: 'user_input_quantity', className: 'text-center'},
            {data: 'note', name: 'note', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    dataTableDetailCancelInventoryManage = await DatatableTemplateNew(tableMaterialDetailCancelInventoryManage, res.data[1].original.data, columns, scroll_Y, fixed_left, fixed_right);
}

function closeModalDetailCancelInventoryManage() {
    shortcut.add('F2', function () {
        openCreateCancelInventoryManage();
    });
    $('#modal-detail-cancel-inventory-manage').modal('hide');
    resetModalDetailCancelInventoryManage()
}
function resetModalDetailCancelInventoryManage(){
    $('#branch-detail-cancel-inventory-manage').text('---');
    $('#employee-detail-cancel-inventory-manage').text('---');
    $('#code-detail-cancel-inventory-manage').text('---');
    $('#inventory-detail-cancel-inventory-manage').text('---');
    $('#total-record-detail-cancel-inventory-manage').text('---');
    $('#note-detail-cancel-inventory-manage').text('---');
    $('#total-sum-price-detail-cancel-inventory-manage').text('---');
    $('#date-detail-cancel-inventory-manage').text(moment().format('DD/MM/YYYY'));
    $('#create-detail-cancel-inventory-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    dataTableDetailCancelInventoryManage.clear().draw(false);
}
