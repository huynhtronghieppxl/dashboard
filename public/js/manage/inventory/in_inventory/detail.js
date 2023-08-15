let dataTableMaterialDetailInInventoryManage, idEmployeeDetailInInventoryManage;
function openDetailInInventoryManage(r) {
    $('#modal-detail-in-inventory-manage').modal('show');
        shortcut.remove('ESC')
        shortcut.add('ESC', function () {
            closeModalDetailInInventoryManage();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC')
        shortcut.add('ESC', function () {
            closeModalDetailInInventoryManage();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove('ESC')
        shortcut.add('ESC', function () {
            closeModalDetailInInventoryManage();
        });
    });
    $('#employee-detail-in-inventory-manage').unbind('click').on('click', function () {
        openModalInfoEmployeeManage(idEmployeeDetailInInventoryManage);
    })
    dataDetailInInventoryManage(r.data('id'), r.data('branch'));
}

async function dataDetailInInventoryManage(id, branch) {
    let method = 'get',
        url = 'in-inventory-manage.detail',
        params = {
            id: id,
            branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-in-inventory-manage'),
        $('#box-list-detail-in-inventory-manage'),
    ]);
    $('#status-detail-in-inventory-manage').html(res.data[1].paid_status);
    $('#branch-detail-in-inventory-manage').text(res.data[1].branch);
    $('#code-detail-in-inventory-manage').text(res.data[1].code);
    if(res.data[1].supplier === ''){
        $('#supplier-detail-in-inventory-manage').text('---');
    } else {
        $('#supplier-detail-in-inventory-manage').text(res.data[1].supplier);
    }

    if(res.data[2].data.discount_type === 0){
        $('#discount-percent-detail-in-inventory-manage').addClass('d-none');
    } else {
        $('#discount-percent-detail-in-inventory-manage').removeClass('d-none');
    }

    $('#image-supplier-detail-in-inventory-manage').text(res.data[1].supplier_avatar);
    $('#inventory-detail-in-inventory-manage').text(res.data[1].inventory);
    $('#employee-detail-in-inventory-manage').text(res.data[1].employee);
    $('#employee-detail-in-inventory-manage').attr('data-id', res.data[2].data.employee.id);
    $('#create-detail-in-inventory-manage').text(res.data[1].create);
    $('#discount-percent-detail-in-inventory-manage').text('(' + res.data[2].data.discount_percent + '%)');
    $('#vat-percent-detail-in-inventory-manage').text('(' + res.data[2].data.vat + '%)');
    $('#date-detail-in-inventory-manage').text(res.data[1].delivery);
    $('#total-sum-price-detail-in-inventory-manage').text(res.data[1].total);
    $('#discount-detail-in-inventory-manage').text(res.data[1].discount);
    $('#image-employee-detail-in-inventory').attr('src',res.data[1].employee_avatar);
    $('#vat-detail-in-inventory-manage').text(res.data[1].vat);
    $('#total-final-detail-in-inventory-manage').text(res.data[1].total_final);
    $('#total-record-material-detail-in-inventory-manage').text(res.data[1].total_record_material);
    drawTableDetailInInventoryManage(res.data[0].original.data);
    idEmployeeDetailInInventoryManage = res.data[2].data.employee.id;
}

async function drawTableDetailInInventoryManage(data) {
    let id = $('#table-material-detail-in-inventory-manage'),
        scroll_Y = '50vh',
        fixed_left = 2,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'user_input_quantity', name: 'user_input_quantity', className: 'text-center'},
            {data: 'user_input_price', name: 'user_input_price', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    dataTableMaterialDetailInInventoryManage = await DatatableTemplateNew(id, data, column, scroll_Y, fixed_left, fixed_right);
}

function closeModalDetailInInventoryManage() {
    $('#modal-detail-in-inventory-manage').modal('hide');
    dataTableMaterialDetailInInventoryManage.clear().draw(false);
    resetModalDetailInInventoryManage()
}
function resetModalDetailInInventoryManage(){
    $('#status-detail-in-inventory-manage').html('---');
    $('#branch-detail-in-inventory-manage').text('---');
    $('#code-detail-in-inventory-manage').text('---');
    $('#supplier-detail-in-inventory-manage').text('---');
    $('#inventory-detail-in-inventory-manage').text('---');
    $('#employee-detail-in-inventory-manage').text('---');
    $('#create-detail-in-inventory-manage').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#date-detail-in-inventory-manage').text(moment().format('DD/MM/YYYY'));
    $('#total-sum-price-detail-in-inventory-manage').text(0);
    $('#discount-detail-in-inventory-manage').text(0);
    $('#vat-detail-in-inventory-manage').text(0);
    $('#total-final-detail-in-inventory-manage').text(0);
    $('#total-record-material-detail-in-inventory-manage').text(0);
}


