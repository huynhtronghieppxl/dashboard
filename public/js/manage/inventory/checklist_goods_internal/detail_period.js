let dataTableDetailPeriodCheckListGoodsInternalDayManage;
let idEmployeeCreateDetailPeriod, idEmployeeUpdateDetailPeriod, idEmployeeConfirmDetailPeriod, idEmployeeCancelDetailPeriod;
async function openDetailPeriodChecklistGoodsInternalManage(id, creator_type) {
    console.log({creator_type})
    if(creator_type === 2) {
    $('#modal-detail-period-checklist-goods-internal-manage').modal('show');
    shortcut.add('ESC', function () {
        closeModalDetailPeriodChecklistGoodsInternalManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailPeriodChecklistGoodsInternalManage();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailPeriodChecklistGoodsInternalManage();
        });
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailPeriodChecklistGoodsInternalManage();
        });
    });
    dataDetailPeriodChecklistGoodsInternalManage(id);
    }else {
        openDetailChecklistGoodsInternalManage(id, 1);
    }
}

async function dataDetailPeriodChecklistGoodsInternalManage(id) {
    let method = 'get',
        url = 'checklist-goods-internal-manage.detail',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#table-detail-period-checklist-goods-internal-manage_wrapper'), $('#box-info-right-detail-period-checklist-goods-internal-manage')]);
    switch (res.data[1].data.status) {
        case 2:
            $('#div-confirm-detail-period-checklist-goods-internal-manage').removeClass('d-none');
            $('#div-cancel-detail-period-checklist-goods-internal-manage').addClass('d-none');
            break;
        case 3:
            $('#div-cancel-detail-period-checklist-goods-internal-manage').removeClass('d-none');
            $('#div-confirm-detail-period-checklist-goods-internal-manage').addClass('d-none');
            break;
        default:
            $('#div-confirm-detail-period-checklist-goods-internal-manage').addClass('d-none');
            $('#div-cancel-detail-period-checklist-goods-internal-manage').addClass('d-none');
    }
    idEmployeeCreateDetailPeriod = res.data[1].data.employee_create.id;
    idEmployeeUpdateDetailPeriod = res.data[1].data.employee_edit.id;
    idEmployeeConfirmDetailPeriod = res.data[1].data.employee_complete.id;
    idEmployeeCancelDetailPeriod = res.data[1].data.employee_cancel.id;
    $('#branch-detail-period-checklist-goods-internal-manage').text(res.data[1].data.branch_name);
    $('#code-detail-period-checklist-goods-internal-manage').text(res.data[1].data.code);
    $('#inventory-detail-period-checklist-goods-internal-manage').text(res.data[1].data.inventory);
    $('#type-detail-period-checklist-goods-internal-manage').text(res.data[1].data.type);

    $('#employee-create-detail-period-checklist-goods-internal-manage').text(res.data[1].data.employee_create.name);
    $('#create-detail-period-checklist-goods-internal-manage').text(res.data[1].data.employee_create_at);
    $('#employee-create-detail-period-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ idEmployeeCreateDetailPeriod +')');

    if(res.data[1].data.employee_edit.id) {
        $('#employee-update-detail-period-checklist-goods-internal-manage').text(res.data[1].data.employee_edit.name);
        $('#update-detail-period-checklist-goods-internal-manage').text(res.data[1].data.employee_update_at);
        $('#employee-update-detail-period-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ idEmployeeUpdateDetailPeriod +')');
    }else {
        $('#employee-update-detail-period-checklist-goods-internal-manage').text('---');
    }
    if(res.data[1].data.employee_complete.id) {
        $('#employee-confirm-detail-period-checklist-goods-internal-manage').text(res.data[1].data.employee_complete.name);
        $('#confirm-detail-period-checklist-goods-internal-manage').text(res.data[1].data.employee_complete_at);
        $('#employee-confirm-detail-period-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ idEmployeeConfirmDetailPeriod +')');
    }else{
        $('#employee-confirm-detail-period-checklist-goods-internal-manage').text('---');
    }
    if(res.data[1].data.employee_cancel.id) {
        $('#employee-cancel-detail-period-checklist-goods-internal-manage').text(res.data[1].data.employee_cancel.name);
        $('#cancel-detail-treasurer-checklist-goods-internal-manage').text(res.data[1].data.employee_cancel_at);
        $('#employee-cancel-detail-period-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ idEmployeeCancelDetailPeriod +')');
        $('#reason-detail-period-checklist-goods-internal-manage').text(res.data[1].data.employee_cancel_note);
    }
    $('#confirm-note-detail-period-checklist-goods-internal-manage').text(res.data[1].data.employee_create_note ? res.data[1].data.employee_create_note : '---');
    $('#confirm-note-detail-period-checklist-goods-internal-manage').text(res.data[1].data.employee_update_note ? res.data[1].data.employee_update_note : '---');
    $('#image-employee-create-detail-period-checklist-goods-internal-manage').attr('src', res.data[2].employee_avatar);
    $('#image-employee-confirm-detail-period-checklist-goods-internal-manage').attr('src', res.data[2].employee_confirm_avatar);
    $('#image-employee-update-detail-period-checklist-goods-internal-manage').attr('src', res.data[2].employee_edit_avatar);
    $('#image-employee-cancel-detail-period-checklist-goods-internal-manage').attr('src', res.data[2].employee_cancel_avatar);
    dataTableMaterialDetailPeriodCheckListGoodsInternalDayManage(res.data[0].original.data);
}

async function dataTableMaterialDetailPeriodCheckListGoodsInternalDayManage(data) {
    let tableDetailPeriodCheckListGoodsInternalManage = $('#table-detail-period-checklist-goods-internal-manage'),
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
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ], option = [];
    dataTableDetailPeriodCheckListGoodsInternalDayManage = await DatatableTemplateNew(tableDetailPeriodCheckListGoodsInternalManage, data, columns, '50vh', fixed_left, fixed_right, option);
}

function closeModalDetailPeriodChecklistGoodsInternalManage() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-detail-period-checklist-goods-internal-manage').modal('hide');
    resetModalDetailPeriodChecklistGoodsInternalManage();
}
function resetModalDetailPeriodChecklistGoodsInternalManage(){
    $('#branch-detail-period-checklist-goods-internal-manage').text('---');
    $('#code-detail-period-checklist-goods-internal-manage').text('---');
    $('#inventory-detail-period-checklist-goods-internal-manage').text('---');
    $('#employee-create-detail-period-checklist-goods-internal-manage').text('---');
    $('#employee-update-detail-period-checklist-goods-internal-manage').text('---');
    $('#employee-confirm-detail-period-checklist-goods-internal-manage').text('---');
    $('#confirm-detail-period-checklist-goods-internal-manage').text('---');
    $('#employee-cancel-detail-period-checklist-goods-internal-manage').text('---');
    $('#cancel-detail-period-checklist-goods-internal-manage').text('---');
    $('#check-note-detail-period-checklist-goods-internal-manage').text('---');
    $('#create-detail-period-checklist-goods-internal-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#update-detail-period-checklist-goods-internal-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#confirm-note-detail-period-checklist-goods-internal-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    dataTableDetailPeriodCheckListGoodsInternalDayManage.clear().draw(false);
}
