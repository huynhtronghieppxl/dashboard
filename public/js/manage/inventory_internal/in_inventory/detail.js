let tableMaterialDetailInInventoryManage = '', idCodeOutDetailInInventoryInternalManage,
idBranchCodeOutDetailInInventoryInternalManage, idEmployeeCreateOutDetailInInventoryInternalManage;
function openDetailInInventoryInventoryManage(id) {
    $('#modal-detail-in-inventory-internal-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeDetailInInventoryInventoryManage()
    })
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeDetailInInventoryInventoryManage()
        })
    })
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeDetailInInventoryInventoryManage();
        });
    });
    $('#modal-detail-out-inventory-manage').on('hidden.bs.modal', function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeDetailInInventoryInventoryManage();
        });
    });
    $('#code-out-detail-in-inventory-internal-manage').unbind('click').on('click', function (){
        openDetailOutInventoryManage(idCodeOutDetailInInventoryInternalManage, idBranchCodeOutDetailInInventoryInternalManage)
    })
    $('#employee-detail-in-inventory-internal-manage').unbind('click').on('click', function (){
        openModalInfoEmployeeManage(idEmployeeCreateOutDetailInInventoryInternalManage);
    })
    $(document).on('input paste', '#table-material-detail-in-inventory-internal-manage_filter input', function (){
        let totalAmount = 0;
        tableMaterialDetailInInventoryManage.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            totalAmount += removeformatNumber(row.find('td:eq(4)').text())
        })
        $('#total-amount-detail-in-inventory-internal-manage').text(formatNumber(totalAmount))
    })
    dataDetailInInventoryInventoryManage(id);
}

async function dataDetailInInventoryInventoryManage(id) {
    let method = 'get',
        url = 'in-inventory-internal-manage.detail',
        params = {
            id: id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-in-inventory-internal-manage'),
        $('#box-list-detail-in-inventory-internal-manage')]);
    idCodeOutDetailInInventoryInternalManage = res.data[1].data.warehouse_session_detail.id
    idBranchCodeOutDetailInInventoryInternalManage = res.data[1].data.warehouse_session_detail.branch.id
    idEmployeeCreateOutDetailInInventoryInternalManage = res.data[1].data.employee_id
    $('#branch-name-detail-in-inventory-internal-manage').text(res.data[1].data.branch_name);
    $('#inventory-detail-in-inventory-internal-manage').text(res.data[1].data.inventory);
    $('#code-in-detail-in-inventory-internal-manage').text(res.data[1].data.code);
    $('#code-out-detail-in-inventory-internal-manage').text(res.data[1].data.warehouse_session_detail.code);
    $('#image-employee-detail-in-inventory-internal-manage').attr('src', res.data[1].data.employee_avatar)
    $('#employee-detail-in-inventory-internal-manage').text(res.data[1].data.employee_full_name);
    $('#date-detail-in-inventory-internal-manage').text(res.data[1].data.created_at);
    $('#total-amount-detail-in-inventory-internal-manage').text(formatNumber(res.data[1].data.total_amount));
    $('#total-final-detail-inventory-internal-manage').text(formatNumber(res.data[1].data.total_amount));
    if(res.data[1].data.note !== ''){
        $('#note-name-detail-in-inventory-internal-manage').text(res.data[1].data.note);
    }
    let tableMaterialDetailInInventoryInternalManage = $('#table-material-detail-in-inventory-internal-manage'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'material_name', className: 'text-left'},
            {data: 'user_input_quantity', name: 'user_input_quantity', className: 'text-center'},
            {data: 'user_input_price', name: 'user_input_price', className: 'text-center'},
            {data: 'total_price', name: 'total_price', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    tableMaterialDetailInInventoryManage = await DatatableTemplateNew(tableMaterialDetailInInventoryInternalManage, res.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right);
}

function closeDetailInInventoryInventoryManage() {
    $('#modal-detail-in-inventory-internal-manage').modal('hide');
    resetDetailInInventoryInventoryManage()
}
function resetDetailInInventoryInventoryManage(){
    $('#branch-name-detail-in-inventory-internal-manage').text('---');
    $('#inventory-detail-in-inventory-internal-manage').text('---');
    $('#employee-detail-in-inventory-internal-manage').text('---');
    $('#date-detail-in-inventory-internal-manage').text('---');
    $('#note-name-detail-in-inventory-internal-manage').text('---');
    $('#total-amount-detail-in-inventory-internal-manage').text(0);
    tableMaterialDetailInInventoryManage.clear().draw(false);
}
