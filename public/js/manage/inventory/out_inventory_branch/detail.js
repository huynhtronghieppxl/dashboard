let dataTableDetailOutInventoryInternalManage, idEmployeeDetailOutInventoryBranchManage,
    idEmployeeCancelDetailOutInventoryBranchManage, statusOutInventoryBranchManage, idEmployeeConfirmDetailOutInventoryBranchManage;

$(function (){
})
function openDetailOutInventoryInternalManage(id, branch) {
    $('#modal-detail-out-inventory-internal-manage').modal('show');
    shortcut.add('ESC', function () {
        closeModalDetailOutInventoryInternalManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailOutInventoryInternalManage();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailOutInventoryInternalManage();
        });
    });
    $('#employee-detail-out-inventory-internal-manage').on('click', function (){
        openModalInfoEmployeeManage(idEmployeeDetailOutInventoryBranchManage)
    })
    $('#employee-cancel-detail-out-inventory-internal-manage').on('click', function (){
        openModalInfoEmployeeManage(idEmployeeCancelDetailOutInventoryBranchManage)
    })
    $('#employee-confirmed-detail-out-inventory-internal-manage').on('click', function (){
        openModalInfoEmployeeManage(idEmployeeConfirmDetailOutInventoryBranchManage)
    })
    dataDetailOutInventoryInternalManage(id, branch);
}

async function dataDetailOutInventoryInternalManage(id, branch) {
    let method = 'get',
        url = 'out-inventory-branch-manage.detail',
        params = {id: id, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-out-inventory-internal-manage'),
        $('#box-list-detail-out-inventory-internal-manage')
    ]);
    idEmployeeDetailOutInventoryBranchManage = res.data[1].employee_id
    idEmployeeConfirmDetailOutInventoryBranchManage = res.data[1].employee_confirm_id
    idEmployeeCancelDetailOutInventoryBranchManage = res.data[1].employee_cancel_id
    $('#status-detail-out-inventory-internal-manage').html(res.data[1].status);
    $('#branch-detail-out-inventory-internal-manage').text(res.data[1].branch);
    $('#code-detail-out-inventory-internal-manage').text(res.data[1].code);
    $('#target-detail-out-inventory-internal-manage').text(res.data[1].target);
    $('#inventory-detail-out-inventory-internal-manage').text(res.data[1].inventory);
    $('#employee-detail-out-inventory-internal-manage').text(res.data[1].employee);
    $('#image-employee-create-detail-out-inventory-branch').attr('src', res.data[1].employee_avatar)
    $('#create-detail-out-inventory-internal-manage').text(res.data[1].create);
    statusOutInventoryBranchManage = res.data[2].data.warehouse_session_status
    switch (statusOutInventoryBranchManage){
        case 2:
            $('#employee-confirmed-detail-out-inventory-internal-manage').text(res.data[1].employee_confirm);
            $('#image-employee-confirm-detail-out-inventory-branch').attr('src', res.data[1].employee_confirm_avatar)
            $('#confirmed-detail-out-inventory-internal-manage').text(res.data[1].date_confirm)
            $('#cancel-detail-out-inventory-internal-manage-div').addClass('d-none');
            $('#cancel-reason-detail-out-inventory-branch-manage-div').addClass('d-none');
            $('#confirmed-detail-out-inventory-internal-manage-div').removeClass('d-none');
            break;
        case 3:
            $('#cancel-detail-out-inventory-internal-manage-div').removeClass('d-none');
            $('#confirmed-detail-out-inventory-internal-manage-div').addClass('d-none');
            $('#cancel-reason-detail-out-inventory-branch-manage-div').removeClass('d-none');
            $('#employee-cancel-detail-out-inventory-internal-manage').text(res.data[1].employee_cancel);
            $('#image-employee-cancel-detail-out-inventory-branch').attr('src', res.data[1].employee_cancel_avatar)
            $('#cancel-detail-out-inventory-internal-manage').text(res.data[1].date_confirm)
            break;
        default:
            $('#cancel-detail-out-inventory-internal-manage-div').addClass('d-none');
            $('#confirmed-detail-out-inventory-internal-manage-div').addClass('d-none');
            $('#cancel-reason-detail-out-inventory-branch-manage-div').addClass('d-none');

    }
    $('#date-detail-out-inventory-internal-manage').text(res.data[1].delivery);
    $('#total-record-detail-out-inventory-internal-manage').text(res.data[1].total_record);
    $('#total-detail-out-inventory-internal-manage').text(res.data[1].total);
    if(res.data[1].cancel_reason === ''){
        $('#cancel-reason-detail-out-inventory-branch-manage').text('---')
    }
    else{
        $('#cancel-reason-detail-out-inventory-branch-manage').text(res.data[1].cancel_reason);
    }
    if(res.data[1].note === ''){
        $('#note-detail-out-inventory-internal-manage').text('---')
    }
    else{
        $('#note-detail-out-inventory-internal-manage').text(res.data[1].note);

    }

    let tableMaterialDetailOutInventoryInternalManage = $('#table-material-detail-out-inventory-internal-manage'),
        scroll_Y = '50vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'material_name', className: 'text-left'},
            {data: 'user_input_quantity', name: 'user_input_quantity', className: 'text-center'},
            {data: 'user_input_price', name: 'user_input_price', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ], option = []
    dataTableDetailOutInventoryInternalManage = await DatatableTemplateNew(tableMaterialDetailOutInventoryInternalManage, res.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right, option);
}

function closeModalDetailOutInventoryInternalManage() {
    shortcut.remove('ESC');
    $('#modal-detail-out-inventory-internal-manage').modal('hide');
    resetModalDetailOutInventoryInternalManage()
}
function resetModalDetailOutInventoryInternalManage(){
    $('#status-detail-out-inventory-internal-manage').html('---');
    $('#branch-detail-out-inventory-internal-manage').text('---');
    $('#code-detail-out-inventory-internal-manage').text('---');
    $('#target-detail-out-inventory-internal-manage').text('---');
    $('#inventory-detail-out-inventory-internal-manage').text('---');
    $('#employee-detail-out-inventory-internal-manage').text('---');
    $('#create-detail-out-inventory-internal-manage').text('---');
    $('#date-detail-out-inventory-internal-manage').text('---');
    $('#employee-confirm-detail-out-inventory-internal-manage').text('---');
    $('#total-record-detail-out-inventory-internal-manage').text(0);
    $('#total-detail-out-inventory-internal-manage').text(0);
    $('#note-detail-out-inventory-internal-manage').text('---');
    dataTableDetailOutInventoryInternalManage.clear().draw(false);
}
