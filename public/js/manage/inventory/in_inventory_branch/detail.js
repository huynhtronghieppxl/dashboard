let dataTableDetailInInventoryBranchManage, idCreateDetailInInventoryBranchManage,
    idConfirmDetailInInventoryBranchManage, idCancelDetailInInventoryBranchManage,
    idBranchOutInventoryBranchManage, idOutInventoryBranchManage;
function openDetailInInventoryBranchManage(id, branch) {
    $('#modal-detail-in-inventory-branch-manage').modal('show');
        shortcut.remove("ESC");
        shortcut.add('ESC', function () {
            closeModalDetailInInventoryBranchManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailInInventoryBranchManage();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailInInventoryBranchManage();
        });
    });
    $('#modal-detail-out-inventory-internal-manage').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailInInventoryBranchManage();
        });
    });
    $('#employee-create-detail-in-inventory-branch-manage, #employee-create-detail-waiting-in-inventory-branch-manage').unbind('click').on('click', function () {
        openModalInfoEmployeeManage(idCreateDetailInInventoryBranchManage);
    })
    $('#employee-confirm-detail-in-inventory-branch-manage').unbind('click').on('click', function () {
        openModalInfoEmployeeManage(idConfirmDetailInInventoryBranchManage);
    })
    $('#employee-cancel-detail-in-inventory-branch-manage').unbind('click').on('click', function () {
        openModalInfoEmployeeManage(idCancelDetailInInventoryBranchManage);
    })
    $('#code-out-detail-in-inventory-branch-manage').unbind('click').on('click', function (){
        openDetailOutInventoryInternalManage(idOutInventoryBranchManage, idBranchOutInventoryBranchManage)
    })
    dataDetailInInventoryBranchManage(id, branch);
}

async function dataDetailInInventoryBranchManage(id, branch) {
    let method = 'get',
        url = 'in-inventory-branch-manage.detail',
        params = {id: id, branch_id: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-in-inventory-branch-manage'),
        $('#list-box-detail-in-inventory-branch-manage')
    ]);
    $('#branch-detail-waiting-in-inventory-branch-manage').text(res.data[1].data.target_branch.name);
    $('#import-branch-detail-waiting-in-inventory-branch-manage').text(res.data[1].data.branch.name);
    $('#code-in-detail-waiting-in-inventory-branch-manage').text(res.data[1].data.code);
    $('#inventory-detail-waiting-in-inventory-branch-manage').text(res.data[1].data.inventory);
    $('#date-detail-waiting-in-inventory-branch-manage').text(res.data[1].data.delivery_date);
    $('#employee-create-detail-waiting-in-inventory-branch-manage').text(res.data[1].data.employee.name);
    $('#image-employee-create-detail-waiting-in-inventory-branch-manage').attr('src', res.data[1].data.employee.avatar);

    switch (res.data[1].data.warehouse_session_status) {
        // xác nhận
        case 2:
            $('#confirmed-detail-in-inventory-branch-manage').removeClass('d-none');
            $('#waiting-detail-in-inventory-branch-manage').addClass('d-none');
            break;
        //  đã hủy
        case 3:
            $('#confirmed-detail-in-inventory-branch-manage').addClass('d-none');
            $('#waiting-detail-in-inventory-branch-manage').removeClass('d-none');
            $('#cancel-reason-detail-in-inventory-branch-manage-div').removeClass('d-none');
            break;
        // chờ xác nhận
        default:
            $('#confirmed-detail-in-inventory-branch-manage').addClass('d-none');
            $('#waiting-detail-in-inventory-branch-manage').removeClass('d-none');
            $('#cancel-reason-detail-in-inventory-branch-manage-div').addClass('d-none');

    }
    $('#branch-detail-in-inventory-branch-manage').text(res.data[1].data.branch.name);
    $('#target-detail-in-inventory-branch-manage').text(res.data[1].data.import_from_branch.name);
    $('#status-detail-in-inventory-branch-manage').html(res.data[1].data.status_text);
    $('#code-in-detail-in-inventory-branch-manage').text(res.data[1].data.code);
    $('#code-out-detail-in-inventory-branch-manage').text(res.data[1].data.import_from_warehouse_session_code);
    $('#inventory-detail-in-inventory-branch-manage').text(res.data[1].data.inventory);
    $('#date-detail-in-inventory-branch-manage').text(res.data[1].data.delivery_date);
    $('#create-detail-in-inventory-branch-manage').text(res.data[1].data.created_at);
    $('#confirm-detail-in-inventory-branch-manage').text(res.data[1].data.updated_at);
    $('#cancel-detail-in-inventory-branch-manage').text(res.data[1].data.updated_at);
    $('#total-price-detail-in-inventory-branch-manage').text(formatNumber(res.data[1].data.total_amount));
    if (res.data[1].data.cancel_reason === ''){
        $('#cancel-reason-detail-in-inventory-branch-manage').text('---')
    }
    else{
        $('#cancel-reason-detail-in-inventory-branch-manage').text(res.data[1].data.cancel_reason);
    }
    if(res.data[1].data.note === ''){
        $('#note-detail-in-inventory-branch-manage').text('---')
    }
    else {
        $('#note-detail-in-inventory-branch-manage').text(res.data[1].data.note);
    }
    //mã phiếu nhập
    idOutInventoryBranchManage = res.data[1].data.import_from_branch_warehouse_session_id
    idBranchOutInventoryBranchManage = res.data[1].data.import_from_branch.id
    //người xác nhận
    $('#image-employee-confirm-detail-in-inventory-branch-manage').attr('src', res.data[1].data.employee_complete.avatar);
    $('#employee-confirm-detail-in-inventory-branch-manage').text(res.data[1].data.employee_complete.name);
    idConfirmDetailInInventoryBranchManage = res.data[1].data.employee_complete.id;
    //người tạo
    $('#image-employee-create-detail-in-inventory-branch-manage').attr('src', res.data[1].data.employee.avatar);
    $('#employee-create-detail-in-inventory-branch-manage').text(res.data[1].data.employee.name);
    idCreateDetailInInventoryBranchManage = res.data[1].data.employee.id;
    //người hủy
    $('#image-employee-cancel-detail-in-inventory-branch-manage').attr('src', res.data[1].data.employee_edit.avatar);
    $('#employee-cancel-detail-in-inventory-branch-manage').text(res.data[1].data.employee_edit.name);
    idCancelDetailInInventoryBranchManage = res.data[1].data.employee_edit.id;
    let tableMaterialDetailInInventoryBranchManage = $('#table-material-detail-in-inventory-branch-manage'),
        scroll_Y = '50vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'material_name', className: 'text-left'},
            {data: 'user_input_quantity', name: 'user_input_quantity', className: 'text-center'},
            {data: 'user_input_price', name: 'unit_price', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ], option = []
    dataTableDetailInInventoryBranchManage = await DatatableTemplateNew(tableMaterialDetailInInventoryBranchManage, res.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right, option);
}

function closeModalDetailInInventoryBranchManage() {
    shortcut.remove('ESC');
    $('#modal-detail-in-inventory-branch-manage').modal('hide');
    dataTableDetailInInventoryBranchManage.clear().draw(false);
    resetModalDetailInInventoryBranchManage()
}
function resetModalDetailInInventoryBranchManage(){
    $('#status-detail-in-inventory-branch-manage').html('---');
    $('#modal-detail-in-inventory-branch-manage h6').text('---');
    $('#create-detail-in-inventory-branch-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#update-detail-in-inventory-branch-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#total-price-detail-in-inventory-branch-manage').text(0)
}
