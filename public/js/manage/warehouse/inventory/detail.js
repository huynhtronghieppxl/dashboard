let dataTableDetailInventoryWarehouseManage;
function openDetailInventoryWarehouseManage(r) {
    $('#modal-detail-inventory-warehouse-manage').modal('show');
    $('#branch-detail-inventory-warehouse-manage').text('---');
    $('#code-detail-inventory-warehouse-manage').text('---');
    $('#inventory-detail-inventory-warehouse-manage').text('---');
    $('#time-detail-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY'));
    $('#employee-create-detail-inventory-warehouse-manage').text('---');
    $('#time-create-detail-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-update-detail-inventory-warehouse-manage').text('---');
    $('#time-update-detail-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-confirm-detail-inventory-warehouse-manage').text('---');
    $('#time-confirm-detail-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-cancel-detail-inventory-warehouse-manage').text('---');
    $('#time-cancel-detail-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#note-detail-inventory-warehouse-manage').text('---');
    $('#status-detail-inventory-warehouse-manage').html('---');
    $('#employee-create-confirm-inventory-warehouse-manage').text('---');
    $('#employee-update-confirm-inventory-warehouse-manage').text('---');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailInventoryWarehouseManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailInventoryWarehouseManage();
        });
    })
    dataDetailInventoryWarehouseManage(r.data('id'));
}

async function dataDetailInventoryWarehouseManage(id) {
    let method = 'get',
        url = 'inventory.detail',
        params = {
            id: id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#boxlist-detail-inventory-warehouse-manage')
    ]);
    drawTableDetailInventoryWarehouseManage(res.data[1].original.data);
    switch (res.data[0].status) {
        case 2:
            $('#div-confirm-detail-inventory-warehouse-manage').removeClass('d-none');
            $('#div-cancel-detail-inventory-warehouse-manage').addClass('d-none');
            break;
        case 3:
            $('#div-cancel-detail-inventory-warehouse-manage').removeClass('d-none');
            break;
        default:
            $('#div-confirm-detail-inventory-warehouse-manage').addClass('d-none');
            $('#div-cancel-detail-inventory-warehouse-manage').addClass('d-none');
    }
    $('#branch-detail-inventory-warehouse-manage').text(res.data[0].branch_name);
    $('#code-detail-inventory-warehouse-manage').text(res.data[0].code);
    $('#inventory-detail-inventory-warehouse-manage').text(res.data[0].inventory);
    $('#time-detail-inventory-warehouse-manage').text(res.data[0].time);
    $('#employee-create-detail-inventory-warehouse-manage').text(res.data[0].employee_create_name);
    $('#employee-create-detail-inventory-warehouse-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_create_id +')');
    $('#image-mployee-create-detail-inventory-warehouse-manage').text(res.data[0].employee_create_avartar);
    $('#time-create-detail-inventory-warehouse-manage').text(res.data[0].created_at);
    $('#employee-update-detail-inventory-warehouse-manage').text(res.data[0].employee_edit_name);
    $('#image-employee-update-detail-inventory-warehouse-manage').text(res.data[0].employee_edit_avartar);
    $('#employee-update-detail-inventory-warehouse-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_edit_id +')');
    $('#time-update-detail-inventory-warehouse-manage').text(res.data[0].edited_at);
    $('#employee-confirm-detail-inventory-warehouse-manage').text(res.data[0].employee_confirm_name);
    $('#image-employee-confirm-detail-inventory-warehouse-manage').text(res.data[0].employee_confirm_avartar);
    $('#employee-confirm-detail-inventory-warehouse-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_confirm_id +')');
    $('#time-confirm-detail-inventory-warehouse-manage').text(res.data[0].completed_at);
    $('#employee-cancel-detail-inventory-warehouse-manage').text(res.data[0].employee_cancel_name);
    $('#image-employee-cancel-detail-inventory-warehouse-manage').text(res.data[0].employee_confirm_avartar);
    $('#employee-cancel-detail-inventory-warehouse-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_cancel_id +')');
    $('#time-cancel-detail-inventory-warehouse-manage').text(res.data[0].cancelled_at);
    $('#note-detail-inventory-warehouse-manage').text((res.data[0].note != '' ? res.data[0].note : '-----'));
    $('#reason-detail-inventory-warehouse-manage').text(res.data[0].reason);
    $('#status-detail-inventory-warehouse-manage').html(res.data[0].status_label);
    $('#employee-create-confirm-inventory-warehouse-manage').text(res.data[0].employee_create_name);
    $('#employee-update-confirm-inventory-warehouse-manage').text(res.data[0].employee_edit_name);
}

async function dataMaterialDetailInventoryWarehouseManage(r) {
    let method = 'get',
        url = 'inventory.data-material',
        params = {
            id: r.data('id'),
            branch: r.data('branch'),
            inventory: r.data('inventory'),
            time: r.data('time'),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-inventory-warehouse-manage'),
    ]);
    drawTableDetailInventoryWarehouseManage(res.data[0].original.data);
}

async function drawTableDetailInventoryWarehouseManage(data) {
    let id = $('#table-material-detail-inventory-warehouse-manage'),
        scroll_Y = '40vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'system_last_quantity', name: 'system_last_quantity', className: 'text-center'},
            {data: 'confirm_quantity', name: 'confirm_quantity', className: 'text-center'},
            {data: 'confirm_wastage_quantity', name: 'confirm_wastage_quantity', className: 'text-center'},
            {data: 'note', name: 'note', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    dataTableDetailInventoryWarehouseManage = await DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

function closeModalDetailInventoryWarehouseManage() {
    $('#modal-detail-inventory-warehouse-manage').modal('hide');
    resetModalDetailInventoryWarehouseManage();
}

function resetModalDetailInventoryWarehouseManage() {
    $('#branch-detail-inventory-warehouse-manage').text('---');
    $('#code-detail-inventory-warehouse-manage').text('---');
    $('#inventory-detail-inventory-warehouse-manage').text('---');
    $('#time-detail-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY'));
    $('#employee-create-detail-inventory-warehouse-manage').text('---');
    $('#time-create-detail-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-update-detail-inventory-warehouse-manage').text('---');
    $('#time-update-detail-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-confirm-detail-inventory-warehouse-manage').text('---');
    $('#time-confirm-detail-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-cancel-detail-inventory-warehouse-manage').text('---');
    $('#time-cancel-detail-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#note-detail-inventory-warehouse-manage').text('---');
    $('#status-detail-inventory-warehouse-manage').html('---');
    $('#employee-create-confirm-inventory-warehouse-manage').text('---');
    $('#employee-update-confirm-inventory-warehouse-manage').text('---');
    dataTableDetailInventoryWarehouseManage.clear().draw(false)
}
