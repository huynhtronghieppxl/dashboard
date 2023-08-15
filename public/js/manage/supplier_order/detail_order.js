let dataTableDetailOrderSupplierOrder, idEmployeeSupplierOrder, idEmployeeCompleteSupplierOrder, idEmployeeCancelSupplierOrder;

function openDetailOrderSupplierOrder(id, branch, brand, supplier) {
    $('.swal2-container').addClass('d-none');
    $('#modal-detail-order-supplier-order').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailOrderSupplierOrder();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailOrderSupplierOrder();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailOrderSupplierOrder();
        });
    });
    $('.item-detail-hidden-supplier-order').addClass('d-none');
    dataDetailOrderSupplierOrder(id, branch, brand, supplier);
    $('#employee-detail-order-supplier-order').unbind('click').on('click', function (){
        openModalInfoEmployeeManage(idEmployeeSupplierOrder);
    })
    $('#supplier-system-detail-order-supplier-order').unbind('click').on('click', function (){
        openModalInfoEmployeeManage(idEmployeeSupplierOrder);
    })
    $('#employee-received-detail-order-supplier-order').unbind('click').on('click', function (){
        openModalInfoEmployeeManage(idEmployeeCompleteSupplierOrder);
    })
    $('#employee-cancel-detail-order-supplier-order').unbind('click').on('click', function (){
        if(!idEmployeeCancelSupplierOrder) return false;
        openModalInfoEmployeeManage(idEmployeeCancelSupplierOrder);
    })
}

async function dataDetailOrderSupplierOrder(id, branch, brand , supplier) {
    let method = 'get',
        url = 'supplier-order.data-detail-order',
        params = {brand: brand, branch: branch, id: id , supplier : supplier},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-detail-order-supplier-order'),
        $('#box-list-detail-order-supplier-order'),
    ]);
    if(res.data[0].is_handbook_supplier == 0){
        $('#div-employee-detail-order-supplier-order').addClass('d-none');
        $('#div-supplier-system-detail-order-supplier-order').removeClass('d-none');
        switch (res.data[0].status) {
            case 4:
                $('#div-received-detail-order-supplier-order').removeClass('d-none');
                $('#div-cancel-detail-order-supplier-order').addClass('d-none');
                break;
            case 5:
                $('#div-cancel-detail-order-supplier-order').removeClass('d-none');
                $('#div-received-detail-order-supplier-order').addClass('d-none');
                $('#div-employee-detail-order-supplier-order').removeClass('d-none');
                $('#div-supplier-system-detail-order-supplier-order').addClass('d-none');
                break;
            default:
                $('#div-received-detail-order-supplier-order').addClass('d-none');
                $('#div-cancel-detail-order-supplier-order').addClass('d-none');
        }
    }else{
        $('#div-employee-detail-order-supplier-order').removeClass('d-none');
        $('#div-supplier-system-detail-order-supplier-order').addClass('d-none');
        switch (res.data[0].status) {
            case 4:
                $('#div-received-detail-order-supplier-order').removeClass('d-none');
                $('#div-cancel-detail-order-supplier-order').addClass('d-none');
                break;
            case 5:
                $('#div-cancel-detail-order-supplier-order').removeClass('d-none');
                $('#div-received-detail-order-supplier-order').addClass('d-none');
                break;
            default:
                $('#div-received-detail-order-supplier-order').addClass('d-none');
                $('#div-cancel-detail-order-supplier-order').addClass('d-none');
        }
    }

    drawTableDetailOrderSupplierOrder(res.data[1].original.data);
    idEmployeeSupplierOrder = (res.data[0].employee_created_id);
    $('#branch-detail-order-supplier-order').text(res.data[0].branch_name);
    $('#code-detail-order-supplier-order').text(res.data[0].code);
    $('#supplier-detail-order-supplier-order').text(res.data[0].supplier_name);

    // if(res.data[0].employee_created_full_name === ''){
    //     $('#employee-detail-order-supplier-order-div').addClass('d-none')
    // }
    // else{
    //     $('#employee-detail-order-supplier-order').text(res.data[0].employee_created_full_name);
    // }

    // $('#create-detail-order-supplier-order').text(res.data[0].created_at);
    if(res.data[0].supplier_employee_delivering_name === ''){
        $('#employee-delivery-detail-order-supplier-order').text('---')
        $('#signature-delivery-detail-order-supplier-order-div').addClass('d-none')
    }
    else{
        $('#signature-delivery-detail-order-supplier-order-div').removeClass('d-none')
        $('#employee-delivery-detail-order-supplier-order').text(res.data[0].supplier_employee_delivering_name);
        $('#signature-delivery-detail-order-supplier-order').attr('src', res.data[0].supplier_employee_delivering_avatar);
    }
    $('#employee-received-detail-order-supplier-order').text(res.data[0].employee_complete_full_name);
    idEmployeeCompleteSupplierOrder = res.data[0].employee_complete_id;
    $('#time-detail-order-supplier-order').text(res.data[0].delivery_at);
    $('#date-detail-order-supplier-order').text(res.data[0].received_at);
    $('#discount-percent-detail-order-supplier-order').text((res.data[0].discount_percent == 0 ?  '' : '('+ res.data[0].discount_percent + '%)'));
    $('#vat-percent-detail-order-supplier-order').text('(' + res.data[0].vat + '%)');
    $('#amount-detail-order-supplier-order').text(formatNumber(res.data[0].amount));
    $('#discount-detail-order-supplier-order').text(formatNumber(res.data[0].discount_amount));
    $('#create-detail-order-supplier-order').text(res.data[0].created_at);
    $('#supplier-system-create-detail-order-supplier-order').text(res.data[0].created_at);
    $('#vat-detail-order-supplier-order').text(formatNumber(res.data[0].vat_amount));
    $('#employee-detail-order-supplier-order').text(res.data[0].employee_created_full_name);
    $('#supplier-system-detail-order-supplier-order').text(res.data[0].employee_created_full_name);
    $('#total-amount-detail-order-supplier-order').text(formatNumber(res.data[0].amount_reality));
    $('#total-return-detail-order-supplier-order').text(formatNumber(res.data[0].total_amount_of_return_material_reality));
    $('#total-payment-detail-order-supplier-order').text(res.data[0].status === 3 ? formatNumber(res.data[0].total_amount_reality) : formatNumber(res.data[0].restaurant_debt_amount));
    if(!res.data[0].employee_cancel_id) {
        $('#employee-cancel-detail-order-supplier-order').removeClass('class-link');
        $('#employee-cancel-detail-order-supplier-order').text('Nhà cung cấp hủy');
        $('#image-employee-cancel-detail-order-supplier-order').addClass('d-none');
    }else {
        $('#employee-cancel-detail-order-supplier-order').addClass('class-link');
        $('#employee-cancel-detail-order-supplier-order').text(res.data[0].employee_cancel_full_name);
        $('#image-employee-cancel-detail-order-supplier-order').removeClass('d-none').attr('src', res.data[0].employee_cancel_avatar);
    }
    idEmployeeCancelSupplierOrder =  res.data[0].employee_cancel_id;
    $('#date-cancel-detail-order-supplier-order').text(res.data[0].updated_at);
    $('#reason-detail-order-supplier-order').text(res.data[0].reason);
    $('#image-supplier-detail-order-supplier-order').attr('src', res.data[0].supplier_avatar);
    $('#image-employee-detail-order-supplier-order').attr('src', res.data[0].employee_created_avatar);
    $('#image-supplier-system-detail-order-supplier-order').attr('src', res.data[0].employee_created_avatar);
    $('#image-employee-received-detail-order-supplier-order').attr('src', res.data[0].employee_complete_avatar);
    $('#role-employee-detail-order-supplier-order').text(res.data[0].employee_created_role_name);
}

async function drawTableDetailOrderSupplierOrder(data) {
    let id = $('#table-material-detail-order-supplier-order'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity'},
            {data: 'price_reality', name: 'price_reality', className: 'text-right'},
            {data: 'total_price_reality', name: 'total_price_reality', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    dataTableDetailOrderSupplierOrder = await DatatableTemplateNew(id, data, column,'40vh', fixed_left, fixed_right);
}

function closeModalDetailOrderSupplierOrder() {
    $('.swal2-container').removeClass('d-none');
    $('#modal-detail-order-supplier-order').modal('hide');
    shortcut.remove('ESC');
    resetModalDetailOrderSupplierOrder();
}

function resetModalDetailOrderSupplierOrder() {
    $('#branch-detail-order-supplier-order').text('---');
    $('#supplier-detail-order-supplier-order').text('---');
    $('#employee-detail-order-supplier-order').text('---');
    // $('#create-detail-order-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-delivery-detail-order-supplier-order').text('---');
    $('#signature-delivery-detail-order-supplier-order').attr('---');
    $('#employee-received-detail-order-supplier-order').text('---');
    $('#image-supplier-detail-order-supplier-order').text('---');
    $('#image-employee-detail-order-supplier-order').text('---');
    // $('#time-detail-order-supplier-order').text(moment().format('DD/MM/YYYY'));
    // $('#date-detail-order-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#amount-detail-order-supplier-order').text(0);
    $('#discount-detail-order-supplier-order').text(0);
    $('#vat-detail-order-supplier-order').text(0);
    $('#total-amount-detail-order-supplier-order').text(0);
    $('#total-return-detail-order-supplier-order').text(0);
    $('#total-payment-detail-order-supplier-order').text(0);
    dataTableDetailOrderSupplierOrder.clear().draw(false);
    $('.item-detail-hidden-supplier-order').addClass('d-none');
}
