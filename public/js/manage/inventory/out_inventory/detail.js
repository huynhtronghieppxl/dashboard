let dataTableDetailOutInventoryManage, idEmployeeDetailOutInventoryManage, idEmployeeCompleteDetailOutInventoryManage,
    idEmployeeCancelDetailOutInventoryManage;
function openDetailOutInventoryManage(id, branch) {
    $('#modal-detail-out-inventory-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailOutInventoryManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailOutInventoryManage();
        });
    })
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailOutInventoryManage();
        });
    })
    $('#employee-detail-out-inventory-manage').unbind('click').on('click', function () {
        openModalInfoEmployeeManage(idEmployeeDetailOutInventoryManage);
    })
    $('#employee-confirm-detail-out-inventory-manage').unbind('click').on('click', function () {
        openModalInfoEmployeeManage(idEmployeeCompleteDetailOutInventoryManage);
    })
    $('#employee-cancel-detail-out-inventory-manage').unbind('click').on('click', function () {
        openModalInfoEmployeeManage(idEmployeeCancelDetailOutInventoryManage);
    })
    $(document).on('input paste','#table-material-detail-out-inventory-manage_filter input', async function (){
        let totalAmount = 0;
        await dataTableDetailOutInventoryManage.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            totalAmount += removeformatNumber(row.find('td:eq(4)').text());
        })
        $('#total-amount-material-out-inventory-manage').text(formatNumber(totalAmount))
    })
    dataDetailOutInventoryManage(id, branch);
}

async function dataDetailOutInventoryManage(id, branch) {
    let method = 'get',
        url = 'out-inventory-manage.detail',
        params = {
            id: id,
            branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#box-table-material-detail-out-inventory-manage'),
        $('#box-list-detail-out-inventory-manage')
    ]);
    switch (res.data[2].data.warehouse_session_status) {
        //  đã xác nhận
        case 2:
            $('#div-confirm-detail-out-inventory-manage').removeClass('d-none');
            $('#div-cancel-reason-detail-out-inventory-manage').addClass('d-none');
            $('#div-cancel-detail-out-inventory-manage').addClass('d-none');
            break;
        // hủy
        case 3:
            $('#div-cancel-reason-detail-out-inventory-manage').removeClass('d-none');
            $('#div-confirm-detail-out-inventory-manage').addClass('d-none');
            $('#div-cancel-detail-out-inventory-manage').removeClass('d-none');
            break;
        // chờ xác nhận
        default:
            $('#div-cancel-reason-detail-out-inventory-manage').addClass('d-none');
            $('#div-confirm-detail-out-inventory-manage').addClass('d-none');
            $('#div-cancel-detail-out-inventory-manage').addClass('d-none');
    }
    idEmployeeDetailOutInventoryManage = res.data[2].data.employee.id;
    idEmployeeCompleteDetailOutInventoryManage = res.data[2].data.employee_complete.id;
    idEmployeeCancelDetailOutInventoryManage = res.data[2].data.employee_complete.id;


    $('#status-detail-out-inventory-manage').html(res.data[1].status);
    $('#branch-detail-out-inventory-manage').text(res.data[1].branch);
    $('#code-detail-out-inventory-manage').text(res.data[1].code);
    $('#inventory-detail-out-inventory-manage').text(res.data[1].inventory);
    $('#target-detail-out-inventory-manage').text(res.data[1].target);
    $('#employee-detail-out-inventory-manage').text(res.data[1].employee);
    $('#image-employee-detail-out-inventory-manage').attr('src', res.data[1].employee_avatar);
    $('#create-detail-out-inventory-manage').text(res.data[1].create);
    $('#date-detail-out-inventory-manage').text(res.data[1].delivery);
    $('#employee-confirm-detail-out-inventory-manage').text(res.data[1].employee_confirm);
    $('#image-employee-confirm-detail-out-inventory-manage').attr('src', res.data[1].employee_confirm_avatar);
    $('#employee-cancel-detail-out-inventory-manage').text(res.data[1].employee_cancel);
    $('#image-employee-cancel-detail-out-inventory-manage').attr('src', res.data[1].employee_cancel_avatar);
    $('#cancel-detail-out-inventory-manage').text(res.data[1].update);
    $('#total-record-detail-out-inventory-manage').text(res.data[1].total_record);
    $('#total-amount-material-out-inventory-manage').text(res.data[1].total_amount);
    $('#total-final-detail-out-inventory-manage').text(res.data[1].total_amount)
    if(res.data[2].data.cancel_reason !== ''){
        $('#cancel-reason-detail-out-inventory-manage').text(res.data[2].data.cancel_reason);
    }
    if(res.data[1].note !== ''){
        $('#note-detail-out-inventory-manage').text(res.data[1].note);
    }
    let id_table = $('#table-material-detail-out-inventory-manage'),
        scroll_Y = '50vh',
        fixed_left = 2,
        fixed_right = 2,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'user_input_quantity', name: 'user_input_quantity', className: 'text-center'},
            {data: 'user_input_price', name: 'user_input_price', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none'},
        ];
    dataTableDetailOutInventoryManage = await DatatableTemplateNew(id_table, res.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right);
}

function closeModalDetailOutInventoryManage() {
    $('#modal-detail-out-inventory-manage').modal('hide');
    dataTableDetailOutInventoryManage.clear().draw(false)
    resetModalDetailOutInventoryManage()
}
function resetModalDetailOutInventoryManage(){
    $('#modal-detail-out-inventory-manage h6').text('---');
    $('#total-record-detail-out-inventory-manage').text(0);
}
