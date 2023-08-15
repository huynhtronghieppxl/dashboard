let tableDetailExportWarehouse, idEmployee, idEmployeeConfirm, idEmployeeCancel;
$(function () {
    $(document).on('input paste','#table-material-detail-export-warehouse_filter input', async function (){
        let totalAmount = 0;
        await tableDetailExportWarehouse.rows({'search':'applied'}).every(function (){
            let row = $(this.node());
            totalAmount += removeformatNumber(row.find('td:eq(4)').text());
        })
        $('#total-amount-material-export-inventory-warehouse').text(formatNumber(totalAmount));
    })
})
function openDetailExportWarehouse(id, branch) {
    $('#modal-detail-export-warehouse').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', closeModalDetailExportWarehouse);
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', closeModalDetailExportWarehouse);
    })
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', closeModalDetailExportWarehouse);
    })

    $('#employee-detail-export-warehouse').unbind('click').on('click', () => openModalInfoEmployeeManage(idEmployee));
    $('#employee-confirm-detail-export-warehouse').unbind('click').on('click', () => openModalInfoEmployeeManage(idEmployeeConfirm));
    $('#employee-cancel-detail-export-warehouse').unbind('click').on('click', () => openModalInfoEmployeeManage(idEmployeeCancel));
    dataDetailExportWarehouse(id, branch);
}

async function dataDetailExportWarehouse(id, branch) {
    let method = 'get',
        url = 'export-inventory-warehouse.detail',
        params = {
            id: id,
            branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#box-table-material-detail-export-warehouse'),
        $('#box-list-detail-export-warehouse')
    ]);
    switch (res.data[2].data.warehouse_session_status) {
        //  đã xác nhận
        case 2:
            $('#div-confirm-detail-export-warehouse').removeClass('d-none');
            $('#div-cancel-reason-detail-export-warehouse').addClass('d-none');
            $('#div-cancel-detail-export-warehouse').addClass('d-none');
            break;
        // hủy
        case 3:
            $('#div-cancel-reason-detail-export-warehouse').removeClass('d-none');
            $('#div-confirm-detail-export-warehouse').addClass('d-none');
            $('#div-cancel-detail-export-warehouse').removeClass('d-none');
            break;
        // chờ xác nhận
        default:
            $('#div-cancel-reason-detail-export-warehouse').addClass('d-none');
            $('#div-confirm-detail-export-warehouse').addClass('d-none');
            $('#div-cancel-detail-export-warehouse').addClass('d-none');
    }
    idEmployee = res.data[2].data.employee.id;
    idEmployeeConfirm = res.data[2].data.employee_complete.id;
    idEmployeeCancel = res.data[2].data.employee_complete.id;


    $('#status-detail-export-warehouse').html(res.data[1].status);
    $('#branch-detail-export-warehouse').text(res.data[1].branch);
    $('#code-detail-export-warehouse').text(res.data[1].code);
    $('#inventory-detail-export-warehouse').text(res.data[1].inventory);
    $('#target-detail-export-warehouse').text(res.data[1].target);
    $('#employee-detail-export-warehouse').text(res.data[1].employee);
    $('#image-employee-detail-export-warehouse').attr('src', res.data[1].employee_avatar);
    $('#create-detail-export-warehouse').text(res.data[1].create);
    $('#date-detail-export-warehouse').text(res.data[1].delivery);
    $('#employee-confirm-detail-export-warehouse').text(res.data[1].employee_confirm);
    $('#image-employee-confirm-detail-export-warehouse').attr('src', res.data[1].employee_confirm_avatar);
    $('#employee-cancel-detail-export-warehouse').text(res.data[1].employee_cancel);
    $('#image-employee-cancel-detail-export-warehouse').attr('src', res.data[1].employee_cancel_avatar);
    $('#cancel-detail-export-warehouse').text(res.data[1].update);
    $('#total-record-detail-export-warehouse').text(res.data[1].total_record);
    $('#total-amount-material-export-inventory-warehouse').text(res.data[1].total_amount);
    $('#total-final-detail-export-warehouse').text(res.data[1].total_amount)
    if(res.data[2].data.cancel_reason !== ''){
        $('#cancel-reason-detail-export-warehouse').text(res.data[2].data.cancel_reason);
    }
    if(res.data[1].note !== ''){
        $('#note-detail-export-warehouse').text(res.data[1].note);
    }
    let id_table = $('#table-material-detail-export-warehouse'),
        scroll_Y = '50vh',
        fixed_left = 2,
        fixed_right = 2,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'user_input_quantity', name: 'user_input_quantity', className: 'text-center'},
            {data: 'user_input_price', name: 'user_input_price', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none'},
        ];
    tableDetailExportWarehouse = await DatatableTemplateNew(id_table, res.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right);
}

function closeModalDetailExportWarehouse() {
    $('#modal-detail-export-warehouse').modal('hide');
    tableDetailExportWarehouse.clear().draw(false);
    resetModalDetailOutInventoryManage();
}
function resetModalDetailOutInventoryManage(){
    $('#modal-detail-export-warehouse h6').text('---');
    $('#total-record-detail-export-warehouse').text(0);
}
