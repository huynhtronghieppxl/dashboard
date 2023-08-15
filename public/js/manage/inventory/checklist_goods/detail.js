let dataTableDetailCheckListGoodsManage;
function openDetailCheckListGoodsManage(r) {
    $('#modal-detail-checklist-goods-manage').modal('show');
    // $('#branch-detail-checklist-goods-manage').text('---');
    // $('#code-detail-checklist-goods-manage').text('---');
    // $('#inventory-detail-checklist-goods-manage').text('---');
    // $('#time-detail-checklist-goods-manage').text(moment().format('DD/MM/YYYY'));
    // $('#employee-create-detail-checklist-goods-manage').text('---');
    // $('#time-create-detail-checklist-goods-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    // $('#employee-update-detail-checklist-goods-manage').text('---');
    // $('#time-update-detail-checklist-goods-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    // $('#employee-confirm-detail-checklist-goods-manage').text('---');
    // $('#time-confirm-detail-checklist-goods-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    // $('#employee-cancel-detail-checklist-goods-manage').text('---');
    // $('#time-cancel-detail-checklist-goods-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    // $('#note-detail-checklist-goods-manage').text('---');
    // $('#status-detail-checklist-goods-manage').html('---');
    // $('#employee-create-confirm-checklist-goods-manage').text('---');
    // $('#employee-update-confirm-checklist-goods-manage').text('---');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailCheckListGoodsManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailCheckListGoodsManage();
        });
    })
    dataDetailCheckListGoodsManage(r.data('id'),r);
}

async function dataDetailCheckListGoodsManage(id, r) {
    let method = 'get',
        url = 'checklist-goods-manage.detail',
        params = {
            id: id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#boxlist-detail-checklist-goods-manage')
    ]);
    drawTableDetailCheckListGoodsManage(res.data[1].original.data);
    switch (res.data[0].status) {
        case 2:
            $('#div-confirm-detail-checklist-goods-manage').removeClass('d-none');
            $('#div-cancel-detail-checklist-goods-manage').addClass('d-none');
            break;
        case 3:
            $('#div-cancel-detail-checklist-goods-manage').removeClass('d-none');
            break;
        default:
            $('#div-confirm-detail-checklist-goods-manage').addClass('d-none');
            $('#div-cancel-detail-checklist-goods-manage').addClass('d-none');
    }
    $('#status-detail-checklist-goods-manage').html(res.data[0].status_label);
    $('#branch-detail-checklist-goods-manage').text(res.data[0].branch_name);
    $('#code-detail-checklist-goods-manage').text(res.data[0].code);
    $('#inventory-detail-checklist-goods-manage').text(res.data[0].inventory);
    $('#time-detail-checklist-goods-manage').text(res.data[0].time);

    $('#employee-create-detail-checklist-goods-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_create_id +')');
    $('#image-mployee-create-detail-checklist-goods-manage').attr('src', + 'http://172.16.10.118:7080/short/' + r.parents('tr').find('td:eq(2)').find('img').data('src'));
    $('#employee-create-detail-checklist-goods-manage').text(r.parents('tr').find('td:eq(2)').find('.title-name-new-table span').text());
    $('#time-create-detail-checklist-goods-manage').text(res.data[0].employee_create_at);

    if(res.data[0].employee_update_id) {
        $('#employee-update-detail-checklist-goods-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_update_id +')');
        $('#image-employee-update-detail-checklist-goods-manage').attr('src','http://172.16.10.118:7080/short/' + r.data('employee_update_avartar'));
        $('#employee-update-detail-checklist-goods-manage').text(r.data('employee-update-name'));
        $('#time-update-detail-checklist-goods-manage').text(r.data('employee-update-at'));
    }else {
        $('#employee-update-detail-checklist-goods-manage').text('---');
    }

    if(res.data[0].employee_confirm_id) {
        $('#employee-confirm-detail-checklist-goods-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_confirm_id +')');
        $('#image-employee-confirm-detail-checklist-goods-manage').attr('src', 'http://172.16.10.118:7080/short/' + r.parents('tr').find('td:eq(3)').find('img').data('src'));
        $('#employee-confirm-detail-checklist-goods-manage').text(r.parents('tr').find('td:eq(3)').find('.title-name-new-table span').text());
        $('#time-confirm-detail-checklist-goods-manage').text(res.data[0].employee_confirm_at);
    }else {
        $('#employee-confirm-detail-checklist-goods-manage').text('---');
    }

    if(res.data[0].employee_cancel_id) {
        $('#employee-cancel-detail-checklist-goods-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_cancel_id +')');
        $('#image-employee-cancel-detail-checklist-goods-manage').attr('src', 'http://172.16.10.118:7080/short/' + r.parents('tr').find('td:eq(3)').find('img').data('src'));
        $('#employee-cancel-detail-checklist-goods-manage').text(r.parents('tr').find('td:eq(3)').find('.title-name-new-table span').text());
        $('#time-cancel-detail-checklist-goods-manage').text(res.data[0].employee_cancel_at);
        $('#reason-detail-checklist-goods-manage').text(res.data[0].employee_cancel_note ? res.data[0].employee_cancel_note : '---');
    }else {
        $('#employee-cancel-detail-checklist-goods-manage').text('---');
    }

    $('#note-detail-checklist-goods-manage').text((res.data[0].employee_update_id ? res.data[0].employee_update_note : (res.data[0].employee_create_note ? res.data[0].employee_create_note : '---')));
}

async function dataMaterialDetailCheckListGoodsManage(r) {
    let method = 'get',
        url = 'checklist-goods-manage.data-material',
        params = {
            id: r.data('id'),
            branch: r.data('branch'),
            inventory: r.data('inventory'),
            time: r.data('time'),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-checklist-goods-manage'),
    ]);
    drawTableDetailCheckListGoodsManage(res.data[0].original.data);
}

async function drawTableDetailCheckListGoodsManage(data) {
    let id = $('#table-material-detail-checklist-goods-manage'),
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
    dataTableDetailCheckListGoodsManage = await DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

function closeModalDetailCheckListGoodsManage() {
    $('#modal-detail-checklist-goods-manage').modal('hide');
    resetModalDetailCheckListGoodsManage();
}

function resetModalDetailCheckListGoodsManage() {
    $('#branch-detail-checklist-goods-manage').text('---');
    $('#code-detail-checklist-goods-manage').text('---');
    $('#inventory-detail-checklist-goods-manage').text('---');
    $('#time-detail-checklist-goods-manage').text('---');
    $('#employee-create-detail-checklist-goods-manage').text('---');
    $('#time-create-detail-checklist-goods-manage').text('---');
    $('#employee-update-detail-checklist-goods-manage').text('---');
    $('#time-update-detail-checklist-goods-manage').text('---');
    $('#employee-confirm-detail-checklist-goods-manage').text('---');
    $('#time-confirm-detail-checklist-goods-manage').text('---');
    $('#employee-cancel-detail-checklist-goods-manage').text('---');
    $('#time-cancel-detail-checklist-goods-manage').text('---');
    $('#note-detail-checklist-goods-manage').text('---');
    $('#status-detail-checklist-goods-manage').html('---');
    $('#employee-create-confirm-checklist-goods-manage').text('---');
    $('#employee-update-confirm-checklist-goods-manage').text('---');
    dataTableDetailCheckListGoodsManage.clear().draw(false)
}
