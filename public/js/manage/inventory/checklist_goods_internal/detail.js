let dataTableDetailCheckListGoodsInternalDayManage;
let idEmployeeCreateDetailChecklistGoodsInternal, idEmployeeUpdateDetailChecklistGoodsInternal,
    idEmployeeConfirmDetailChecklistGoodsInternal,
    idEmployeeCancelDetailChecklistGoodsInternal
;
async function openDetailChecklistGoodsInternalManage(id, type) {
    if (type === 1) {
        $('#modal-detail-checklist-goods-internal-manage').modal('show');
        shortcut.add('ESC', function () {
            closeModalDetailChecklistGoodsInternalManage();
        });
        dataDetailChecklistGoodsInternalManage(id);
        $('#layout-confirm-detail-checklist-goods-internal-manage').addClass('d-none');
        $('#layout-cancel-detail-checklist-goods-internal-manage').addClass('d-none');
    } else {
        openDetailTreasurerChecklistGoodsInternalManage(id);
    }
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailChecklistGoodsInternalManage();
        });
    });

}

async function dataDetailChecklistGoodsInternalManage(id) {
    let method = 'get',
        url = 'checklist-goods-internal-manage.detail',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-detail-checklist-goods-internal-manage_wrapper'), $('#box-info-right-detail-checklist-goods-internal-manage')]);
    switch (res.data[1].data.status) {
        case 2:
            $('#layout-confirm-detail-checklist-goods-internal-manage').removeClass('d-none');
            break;
        case 3:
            $('#layout-cancel-detail-checklist-goods-internal-manage').removeClass('d-none');
            break;
    }
    idEmployeeCreateDetailChecklistGoodsInternal = res.data[1].data.employee_create.id;
    idEmployeeUpdateDetailChecklistGoodsInternal = res.data[1].data.employee_edit.id;
    idEmployeeConfirmDetailChecklistGoodsInternal = res.data[1].data.employee_confirm.id;
    idEmployeeCancelDetailChecklistGoodsInternal = res.data[1].data.employee_cancel.id;
    $('#branch-detail-checklist-goods-internal-manage').text(res.data[1].data.branch_name);
    $('#code-detail-checklist-goods-internal-manage').text(res.data[1].data.code);
    $('#inventory-detail-checklist-goods-internal-manage').text(res.data[1].data.inventory);
    $('#type-detail-checklist-goods-internal-manage').text(res.data[1].data.type);

    $('#employee-create-detail-checklist-goods-internal-manage').text(res.data[1].data.employee_create.name);
    $('#create-detail-checklist-goods-internal-manage').text(res.data[1].data.employee_create_at);
    $('#employee-create-detail-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ idEmployeeCreateDetailChecklistGoodsInternal +')');
    if(res.data[1].data.employee_edit.id) {
        $('#employee-update-detail-checklist-goods-internal-manage').text(res.data[1].data.employee_edit.name);
        $('#update-detail-checklist-goods-internal-manage').text(res.data[1].data.employee_update_at);
        $('#employee-update-detail-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ idEmployeeUpdateDetailChecklistGoodsInternal +')');
    }else {
        $('#employee-update-detail-checklist-goods-internal-manage').text('---');
    }
    if(res.data[1].data.employee_confirm.id) {
        $('#employee-confirm-detail-checklist-goods-internal-manage').text(res.data[1].data.employee_confirm.name);
        $('#confirm-detail-checklist-goods-internal-manage').text(res.data[1].data.employee_confirm_at);
        $('#employee-confirm-detail-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ idEmployeeConfirmDetailChecklistGoodsInternal +')');
    }else {
        $('#employee-confirm-detail-checklist-goods-internal-manage').text('---');
    }
    if(res.data[1].data.employee_cancel.id) {
        $('#employee-cancel-detail-checklist-goods-internal-manage').text(res.data[1].data.employee_cancel.name);
        $('#cancel-detail-checklist-goods-internal-manage').text(res.data[1].data.employee_cancel_at);
        $('#employee-cancel-detail-checklist-goods-internal-manage').attr('onclick', 'openModalInfoEmployeeManage(' + idEmployeeCancelDetailChecklistGoodsInternal + ')');
        $('#reason-detail-checklist-goods-internal-manage').text(res.data[1].data.employee_cancel_note ? res.data[1].data.employee_cancel_note : '---');
    }
    $('#check-note-detail-checklist-goods-internal-manage').text(res.data[1].data.employee_create_note ? res.data[1].data.employee_create_note : '---' );
    $('#confirm-note-detail-checklist-goods-internal-manage').text(res.data[1].data.employee_update_note ? res.data[1].data.employee_update_note : '---' );
    $('#image-employee-create-detail-checklist-goods-internal-manage').attr('src', res.data[2].employee_avatar);
    $('#image-employee-update-detail-checklist-goods-internal-manage').attr('src', res.data[2].employee_edit_avatar);
    $('#image-employee-confirm-detail-checklist-goods-internal-manage').attr('src', res.data[2].employee_confirm_avatar);
    $('#image-employee-cancel-detail-checklist-goods-internal-manage').attr('src', res.data[2].employee_cancel_avatar);
    dataTableMaterialDetailCheckListGoodsInternalDayManage(res.data[0].original.data);
}

async function dataTableMaterialDetailCheckListGoodsInternalDayManage(data) {
    let tableDetailCheckListGoodInternalManage = $('#table-detail-checklist-goods-internal-manage'),
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'check_quantity', name: 'system_last_quantity', className: 'text-center'},
            {data: 'confirm_quantity', name: 'confirm_quantity', className: 'text-center'},
            {data: 'confirm_note', name: 'confirm_note', className: 'text-center'},
            {data: 'deficiency_treasurer', name: 'deficiency_treasurer', className: 'text-center'},
            {data: 'deficiency_system', name: 'deficiency_system', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    dataTableDetailCheckListGoodsInternalDayManage = await DatatableTemplateNew(tableDetailCheckListGoodInternalManage, data, columns, '50vh', fixed_left, fixed_right);
}

function closeModalDetailChecklistGoodsInternalManage() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-detail-checklist-goods-internal-manage').modal('hide');
    resetModalDetailChecklistGoodsInternalManage();
}
function resetModalDetailChecklistGoodsInternalManage(){
    $('#branch-detail-checklist-goods-internal-manage').text('---');
    $('#code-detail-checklist-goods-internal-manage').text('---');
    $('#inventory-detail-checklist-goods-internal-manage').text('---');
    $('#employee-create-detail-checklist-goods-internal-manage').text('---');
    $('#employee-update-detail-checklist-goods-internal-manage').text('---');
    $('#employee-confirm-detail-checklist-goods-internal-manage').text('---');
    $('#employee-cancel-detail-checklist-goods-internal-manage').text('---');
    $('#cancel-detail-checklist-goods-internal-manage').text('---');
    $('#check-note-detail-checklist-goods-internal-manage').text('---');
    $('#confirm-note-detail-checklist-goods-internal-manage').text('---');
    $('#create-detail-checklist-goods-internal-manage').text('');
    $('#update-detail-checklist-goods-internal-manage').text('');
    $('#confirm-detail-checklist-goods-internal-manage').text('');
    dataTableDetailCheckListGoodsInternalDayManage.clear().draw(false);
}
