let dataTableDetailReturnInventoryWarehouseManage, idCreateDetailReturnInventoryWarehouseManage,
    idConfirmDetailReturnInventoryWarehouseManage, idCancelDetailReturnInventoryWarehouseManage,
    idBranchOutInventoryBranchManage, idOutInventoryBranchManage;
function openDetailReturnInventoryWarehouseManage(id, branch) {
    $('#modal-detail-return-inventory-warehouse-manage').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalDetailReturnInventoryWarehouseManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailReturnInventoryWarehouseManage();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailReturnInventoryWarehouseManage();
        });
    });
    $('#modal-detail-out-inventory-internal-manage').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailReturnInventoryWarehouseManage();
        });
    });
    $('#employee-create-detail-return-inventory-warehouse-manage, #employee-create-detail-waiting-return-inventory-warehouse-manage').unbind('click').on('click', function () {
        openModalInfoEmployeeManage(idCreateDetailReturnInventoryWarehouseManage);
    })
    $('#employee-confirm-detail-return-inventory-warehouse-manage').unbind('click').on('click', function () {
        openModalInfoEmployeeManage(idConfirmDetailReturnInventoryWarehouseManage);
    })
    $('#employee-cancel-detail-return-inventory-warehouse-manage').unbind('click').on('click', function () {
        openModalInfoEmployeeManage(idCancelDetailReturnInventoryWarehouseManage);
    })
    $('#code-out-detail-return-inventory-warehouse-manage').unbind('click').on('click', function (){
        openDetailOutInventoryInternalManage(idOutInventoryBranchManage, idBranchOutInventoryBranchManage)
    })
    dataDetailReturnInventoryWaehouseManage(id, branch);
}

async function dataDetailReturnInventoryWaehouseManage(id, branch) {
    let method = 'get',
        url = 'return-inventory-warehouse.detail',
        params = {id: id, branch_id: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-return-inventory-warehouse-manage'),
        $('#list-box-detail-return-inventory-warehouse-manage')
    ]);
    $('#branch-detail-waiting-return-inventory-warehouse-manage').text(res.data[1].data.target_branch.name);
    $('#import-branch-detail-waiting-return-inventory-warehouse-manage').text(res.data[1].data.branch.name);
    $('#code-in-detail-waiting-return-inventory-warehouse-manage').text(res.data[1].data.code);
    $('#inventory-detail-waiting-return-inventory-warehouse-manage').text(res.data[1].data.inventory);
    $('#date-detail-waiting-return-inventory-warehouse-manage').text(res.data[1].data.delivery_date);
    $('#employee-create-detail-waiting-return-inventory-warehouse-manage').text(res.data[1].data.employee.name);
    $('#image-employee-create-detail-waiting-return-inventory-warehouse-manage').attr('src', res.data[1].data.employee.avatar);

    switch (res.data[1].data.warehouse_session_status) {
        // xác nhận
        case 2:
            $('#confirmed-detail-return-inventory-warehouse-manage').removeClass('d-none');
            $('#waiting-detail-return-inventory-warehouse-manage').addClass('d-none');
            break;
        //  đã hủy
        case 3:
            $('#confirmed-detail-return-inventory-warehouse-manage').addClass('d-none');
            $('#waiting-detail-return-inventory-warehouse-manage').removeClass('d-none');
            $('#cancel-reason-detail-return-inventory-warehouse-manage-div').removeClass('d-none');
            break;
        // chờ xác nhận
        default:
            $('#confirmed-detail-return-inventory-warehouse-manage').addClass('d-none');
            $('#waiting-detail-return-inventory-warehouse-manage').removeClass('d-none');
            $('#cancel-reason-detail-return-inventory-warehouse-manage-div').addClass('d-none');

    }
    $('#branch-detail-return-inventory-warehouse-manage').text(res.data[1].data.branch.name);
    $('#target-detail-return-inventory-warehouse-manage').text(res.data[1].data.import_from_branch.name);
    $('#status-detail-return-inventory-warehouse-manage').html(res.data[1].data.status_text);
    $('#code-in-detail-return-inventory-warehouse-manage').text(res.data[1].data.code);
    $('#code-out-detail-return-inventory-warehouse-manage').text(res.data[1].data.import_from_warehouse_session_code);
    $('#inventory-detail-return-inventory-warehouse-manage').text(res.data[1].data.inventory);
    $('#date-detail-in-return-inventory-warehouse-manage').text(res.data[1].data.delivery_date);
    $('#create-detail-return-inventory-warehouse-manage').text(res.data[1].data.created_at);
    $('#confirm-detail-return-inventory-warehouse-manage').text(res.data[1].data.updated_at);
    $('#cancel-detail-return-inventory-warehouse-manage').text(res.data[1].data.updated_at);
    $('#total-price-detail-return-inventory-warehouse-manage').text(formatNumber(res.data[1].data.total_amount));
    if (res.data[1].data.cancel_reason === ''){
        $('#cancel-reason-detail-return-inventory-warehouse-manage').text('---')
    }
    else{
        $('#cancel-reason-detail-return-inventory-warehouse-manage').text(res.data[1].data.cancel_reason);
    }
    if(res.data[1].data.note === ''){
        $('#note-detail-return-inventory-warehouse-manage').text('---')
    }
    else {
        $('#note-detail-return-inventory-warehouse-manage').text(res.data[1].data.note);
    }
    //mã phiếu nhập
    idOutInventoryBranchManage = res.data[1].data.import_from_branch_warehouse_session_id
    idBranchOutInventoryBranchManage = res.data[1].data.import_from_branch.id
    //người xác nhận
    $('#image-employee-confirm-detail-return-inventory-warehouse-manage').attr('src', res.data[1].data.employee_complete.avatar);
    $('#employee-confirm-detail-return-inventory-warehouse-manage').text(res.data[1].data.employee_complete.name);
    idConfirmDetailReturnInventoryWarehouseManage = res.data[1].data.employee_complete.id;
    //người tạo
    $('#image-employee-create-detail-return-inventory-warehouse-manage').attr('src', res.data[1].data.employee.avatar);
    $('#employee-create-detail-return-inventory-warehouse-manage').text(res.data[1].data.employee.name);
    idCreateDetailReturnInventoryWarehouseManage = res.data[1].data.employee.id;
    //người hủy
    $('#image-employee-cancel-detail-return-inventory-warehouse-manage').attr('src', res.data[1].data.employee_edit.avatar);
    $('#employee-cancel-detail-return-inventory-warehouse-manage').text(res.data[1].data.employee_edit.name);
    idCancelDetailReturnInventoryWarehouseManage = res.data[1].data.employee_edit.id;
    let tableMaterialDetailReturnInventoryWarehouseManage = $('#table-material-detail-return-inventory-warehouse-manage'),
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
    dataTableDetailReturnInventoryWarehouseManage = await DatatableTemplateNew(tableMaterialDetailReturnInventoryWarehouseManage, res.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right, option);
}

function closeModalDetailReturnInventoryWarehouseManage() {
    shortcut.remove('ESC');
    $('#modal-detail-return-inventory-warehouse-manage').modal('hide');
    dataTableDetailReturnInventoryWarehouseManage.clear().draw(false);
    resetModalDetailReturnInventoryWarehouseManage()
}
function resetModalDetailReturnInventoryWarehouseManage(){
    $('#status-detail-return-inventory-warehouse-manage').html('---');
    $('#modal-detail-return-inventory-warehouse-manage h6').text('---');
    $('#create-detail-return-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#update-detail-return-inventory-warehouse-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#total-price-detail-return-inventory-warehouse-manage').text(0)
}
