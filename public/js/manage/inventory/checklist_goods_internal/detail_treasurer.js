let dataTableDetailTreasurerCheckListGoodsInternalDayManage;
let idEmployeeCreateDetailTreasurer, idEmployeeUpdateDetailTreasurer, idEmployeeConfirmDetailTreasurer, idEmployeeCancelDetailTreasurer;
async function openDetailTreasurerChecklistGoodsInternalManage(id) {
    $('#modal-detail-treasurer-checklist-goods-internal-manage').modal('show');
    shortcut.remove("ESC");
    $('#modal-detail-food-brand-manage').on('shown.bs.modal', function () {
        shortcut.add("ESC", function () {
            openModalDetailMaterialData();
        });
    });
    $('#modal-detail-food-brand-manage').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            openDetailTreasurerChecklistGoodsInternalManage();
        });
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailTreasurerChecklistGoodsInternalManage();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailTreasurerChecklistGoodsInternalManage();
        });
    });
    dataDetailTreasurerChecklistGoodsInternalManage(id);
    $('#layout-confirm-detail-treasurer-checklist-goods-internal-manage').addClass('d-none');
    $('#layout-cancel-detail-treasurer-checklist-goods-internal-manage').addClass('d-none');
}

async function dataDetailTreasurerChecklistGoodsInternalManage(id) {
    let method = 'get',
        url = 'checklist-goods-internal-manage.detail',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#table-detail-treasurer-checklist-goods-internal-manage_wrapper'), $('#box-info-right-detail-treasurer-checklist-goods-internal-manage')]);
    switch (res.data[1].data.status) {
        case 2:
            $('#layout-confirm-detail-treasurer-checklist-goods-internal-manage').removeClass('d-none');
            break;
        case 3:
            $('#layout-cancel-detail-treasurer-checklist-goods-internal-manage').removeClass('d-none');
            break;
    }
    idEmployeeCreateDetailTreasurer = res.data[1].data.employee_create.id;
    idEmployeeUpdateDetailTreasurer = res.data[1].data.employee_edit.id;
    idEmployeeConfirmDetailTreasurer = res.data[1].data.employee_confirm.id;
    idEmployeeCancelDetailTreasurer = res.data[1].data.employee_cancel.id;
    $('#branch-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.branch_name);
    $('#code-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.code);
    $('#inventory-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.inventory);
    $('#type-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.type);

    $('#employee-create-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_create.name);
    $('#create-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_create_at);
    $('#employee-create-detail-treasurer-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ idEmployeeCreateDetailTreasurer +')');

    if(res.data[1].data.employee_edit.id) {
        $('#employee-update-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_edit.name);
        $('#update-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_update_at);
        $('#employee-update-detail-treasurer-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ idEmployeeUpdateDetailTreasurer +')');
    }else {
        $('#employee-update-detail-treasurer-checklist-goods-internal-manage').text('---');
    }
    if(res.data[1].data.employee_confirm.id) {
        $('#employee-confirm-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_confirm.name);
        $('#confirm-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_confirm_at);
        $('#employee-confirm-detail-treasurer-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ idEmployeeConfirmDetailTreasurer +')');
    }else {
        $('#employee-confirm-detail-treasurer-checklist-goods-internal-manage').text('---');
    }
    if(res.data[1].data.employee_cancel.id) {
        $('#employee-cancel-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_cancel.name);
        $('#cancel-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_cancel_at);
        $('#employee-cancel-detail-treasurer-checklist-goods-internal-manage').attr('onclick', 'openModalInfoEmployeeManage(' + idEmployeeUpdateDetailTreasurer + ')');
        $('#reason-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_cancel_note ? res.data[1].data.employee_cancel_note : '---');
    }
    $('#check-note-detail-treasurer-checklist-goods-internal-manage').text('---');
    $('#confirm-note-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_update_note ? res.data[1].data.employee_update_note : '---');

    $('#confirm-note-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_update_note ? res.data[1].data.employee_update_note : '---');
    $('#image-employee-create-detail-treasurer-checklist-goods-internal-manage').attr('src', res.data[2].employee_avatar);
    $('#image-employee-update-detail-treasurer-checklist-goods-internal-manage').attr('src', res.data[2].employee_edit_avatar);
    $('#image-employee-confirm-detail-treasurer-checklist-goods-internal-manage').attr('src', res.data[2].employee_confirm_avatar);
    $('#image-employee-cancel-detail-treasurer-checklist-goods-internal-manage').attr('src', res.data[2].employee_cancel_avatar);
    dataTableMaterialDetailTreasurerCheckListGoodsInternalDayManage(res.data[0].original.data);
}

async function dataTableMaterialDetailTreasurerCheckListGoodsInternalDayManage(data) {
    let tableDetailTreasurerCheckListGoodsInternalManage = $('#table-detail-treasurer-checklist-goods-internal-manage'),
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'confirm_quantity', name: 'confirm_quantity', className: 'text-center'},
            {data: 'deficiency_system', name: 'deficiency_system', className: 'text-center'},
            {data: 'confirm_note', name: 'confirm_note', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none', width: '5%'},
        ];
    dataTableDetailTreasurerCheckListGoodsInternalDayManage = await DatatableTemplateNew(tableDetailTreasurerCheckListGoodsInternalManage, data, columns, '50vh', fixed_left, fixed_right);
}

function closeModalDetailTreasurerChecklistGoodsInternalManage() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-detail-treasurer-checklist-goods-internal-manage').modal('hide');
    resetModalDetailTreasurerChecklistGoodsInternalManage()
}
function resetModalDetailTreasurerChecklistGoodsInternalManage(){
    $('#branch-detail-treasurer-checklist-goods-internal-manage').text('---');
    $('#code-detail-treasurer-checklist-goods-internal-manage').text('---');
    $('#inventory-detail-treasurer-checklist-goods-internal-manage').text('---');
    $('#employee-create-detail-treasurer-checklist-goods-internal-manage').text('---');
    $('#employee-update-detail-treasurer-checklist-goods-internal-manage').text('---');
    $('#employee-confirm-detail-treasurer-checklist-goods-internal-manage').text('---');
    $('#confirm-detail-treasurer-checklist-goods-internal-manage').text('---');
    $('#employee-cancel-detail-treasurer-checklist-goods-internal-manage').text('---');
    $('#cancel-detail-treasurer-checklist-goods-internal-manage').text('---');
    $('#check-note-detail-treasurer-checklist-goods-internal-manage').text('---');
    $('#create-detail-treasurer-checklist-goods-internal-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#update-detail-treasurer-checklist-goods-internal-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#confirm-note-detail-treasurer-checklist-goods-internal-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    dataTableDetailTreasurerCheckListGoodsInternalDayManage.clear().draw(false);
}
