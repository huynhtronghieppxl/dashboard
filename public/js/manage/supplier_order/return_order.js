let checkSaveReturnOrderSupplierOrder, tableReturnOrderSupplierOrder, idReturnOrderSupplierOrder,
    branchReturnOrderSupplierOrder, supplierReturnOrderSupplierOrder, deliveryDateSupplierOrder,
    typeDiscountSupplierOrder ,
    discountReturnOrderSupplierOrder, vatReturnOrderSupplierOrder, employeeCreateReturnOrderSupplierOrder, employeeCompleteReturnOrderSupplierOrder;

function openReturnOrderSupplierOrder(id, branch, brand) {
    checkSaveReturnOrderSupplierOrder = 0;
    idReturnOrderSupplierOrder = id;
    branchReturnOrderSupplierOrder = branch;
    $('#modal-return-order-supplier-order').modal('show');
    shortcut.add('ESC', function () {
        closeModalReturnOrderSupplierOrder();
    });
    shortcut.add('F4', function () {
        saveModalReturnSupplierOrder();
    });
    $(document).on('input keydown', '#table-material-return-order-supplier-order input.quantity', async function (e) {
        let quantity = removeformatNumber($(this).val()),
            price = removeformatNumber($(this).parents('tr').find('td:eq(4)').text());

        let discount = 0, vat = 0;
        $(this).parents('tr').find('td:eq(5)').text(formatNumber(quantity * price));
        let total = 0;
        await tableReturnOrderSupplierOrder.rows().every(function () {
            let row = $(this.node());
            total += removeformatNumber(row.find('td:eq(5)').text());
        });
        if ($(this).val() == '.0') {
            $(this).val($(this).val().replace(/^\./, '0.'));
        }
        $('#discount-return-order-supplier-order').text(formatNumber(discount));
        $('#vat-return-order-supplier-order').text(formatNumber(vat));
        $('#total-amount-return-order-supplier-order').text(formatNumber(total - discount + vat));
    });
    $('#employee-received-return-order-supplier-order').unbind('click').on('click', function (){
            openModalInfoEmployeeManage(employeeCompleteReturnOrderSupplierOrder);
    })
    $('#employee-return-order-supplier-order').unbind('click').on('click', function (){
        openModalInfoEmployeeManage(employeeCreateReturnOrderSupplierOrder);
    })
    dataReturnOrderSupplierOrder(id, branch, brand);
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalReturnOrderSupplierOrder();
        });
    })
}

function openNotReturnOrderSupplierOrder() {
    let title = 'Thông báo',
        content = 'Đơn hàng đã trả hết !!!',
        icon = 'warning';
    sweetAlertNotifyComponent(title, content, icon);
}

async function dataReturnOrderSupplierOrder(id, branch, brand) {
    let method = 'get',
        url = 'supplier-order.data-return-order',
        params = {brand: brand, branch: branch, id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#box-list-return-order-supplier-order'),
        $('#table-material-return-order-supplier-order'),
    ]);
    drawTableReturnOrderSupplierOrder(res.data[1].original.data);
    supplierReturnOrderSupplierOrder = res.data[0].supplier_id;
    employeeCreateReturnOrderSupplierOrder = res.data[0].employee_created_id;
    employeeCompleteReturnOrderSupplierOrder = res.data[0].employee_complete_id;
    deliveryDateSupplierOrder = res.data[0].delivery_at;
    $('#branch-return-order-supplier-order').text(res.data[0].branch_name);
    $('#code-return-order-supplier-order').text(res.data[0].code);
    $('#supplier-return-order-supplier-order').text(res.data[0].supplier_name);
    $('#image-supplier-return-order-supplier-order').attr('src',res.data[0].supplier_avatar);
    $('#employee-return-order-supplier-order').text(res.data[0].employee_created_full_name);
    $('#image-employee-return-order-supplier-order').attr('src',res.data[0].employee_created_avatar);
    $('#image-employee-received-return-order-supplier-order').attr('src', res.data[0].employee_complete_avatar);
    $('#discount-percent-return-order-supplier-order').text( res.data[0].discount_percent + '%')
    $('#vat-percent-return-order-supplier-order').text( res.data[0].vat + '%')
    $('#time-return-order-supplier-order').text(res.data[0].delivery_at);
    $('#create-return-order-supplier-order').text(res.data[0].created_at);
    if(res.data[0].supplier_employee_delivering_name === ''){
        $('#employee-delivery-return-order-supplier-order').text('---')
        $('#signature-delivery-return-order-supplier-order-div').addClass('d-none')
    }
    else{
        $('#signature-delivery-return-order-supplier-order-div').removeClass('d-none')
        $('#employee-delivery-return-order-supplier-order').text(res.data[0].supplier_employee_delivering_name);
        $('#signature-delivery-return-order-supplier-order').attr('src', res.data[0].supplier_employee_delivering_avatar);
    }
    $('#employee-received-return-order-supplier-order').text(res.data[0].employee_complete_full_name);
    $('#date-return-order-supplier-order').text(res.data[0].received_at);
    // discountReturnOrderSupplierOrder = checkDecimal(res.data[0].discount_amount / res.data[0].total_amount);
    // vatReturnOrderSupplierOrder = checkDecimal(res.data[0].vat_amount / res.data[0].total_amount);
    if(res.data[0].discount_percent != 0){
        discountReturnOrderSupplierOrder = res.data[0].discount_percent/100;
        $('.reset-discount-price').removeClass('d-none');
    }else {
        // discountReturnOrderSupplierOrder = res.data[0].discount_amount;
        discountReturnOrderSupplierOrder = 0;

        $('.reset-discount-price').addClass('d-none');
    }
    typeDiscountSupplierOrder  = (res.data[0].discount_percent != 0 ? 1 : 0)
    vatReturnOrderSupplierOrder = res.data[0].vat/100;
    $('#amount-return-order-supplier-order').text('0');
    $('#discount-return-order-supplier-order').text('0');
    $('#vat-return-order-supplier-order').text('0');
    $('#total-amount-return-order-supplier-order').text(0);
}

async function drawTableReturnOrderSupplierOrder(data) {
    let id = $('#table-material-return-order-supplier-order'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'pl-5', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center', width: '10%'},
            {data: 'quantity_return', name: 'quantity_return', className: 'text-center', width: '10%'},
            {data: 'price_reality', name: 'price_reality', className: 'text-center'},
            {data: 'total_price_reality', name: 'total_price_reality', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    tableReturnOrderSupplierOrder = await DatatableTemplateNew(id, data, column, '40vh', fixed_left, fixed_right);
}

async function saveModalReturnSupplierOrder() {
    if (checkSaveReturnOrderSupplierOrder !== 0) return false;
    let material = [], note = $('#note-return-order-supplier-order').val();
    tableReturnOrderSupplierOrder.rows().every(function (index, element) {
        let row = $(this.node());
        if (removeformatNumber(row.find('td:eq(3)').find('input').val()) > 0) {
            material.push({
                "supplier_order_detail_id": row.find('td:eq(6)').find('button').data('order-id'),
                "material_id": row.find('td:eq(6)').find('button').data('id'),
                "user_input_quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
                "user_input_unit_type": 1,
                "sort": index,
                "note": JSON.stringify(''),
            })
        }
    });
    if (material.length === 0) {
        let text_warning = 'Vui lòng nhập số lượng cần trả';
        WarningNotify(text_warning);
        return false;
    }
    if (!checkValidateSave($('#modal-return-order-supplier-order'))) {
        $('#loading-return-order-supplier-order').scrollTop($('#loading-return-order-supplier-order').height());
        return false;
    }
    checkSaveReturnOrderSupplierOrder = 1;
    let method = 'post',
        url = 'supplier-order.return-order',
        params = null,
        data = {
            branch: branchReturnOrderSupplierOrder,
            note: note,
            supplier_id: supplierReturnOrderSupplierOrder,
            supplier_order_id: idReturnOrderSupplierOrder,
            delivery_date: deliveryDateSupplierOrder,
            material: material,
        };
    let res = await axiosTemplate(method, url, params, data);
    checkSaveReturnOrderSupplierOrder = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = 'Trả hàng thành công';
            SuccessNotify(text);
            closeModalReturnOrderSupplierOrder();
            loadingData();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function closeModalReturnOrderSupplierOrder() {
    $('#modal-return-order-supplier-order').modal('hide');
    shortcut.remove('ESC');
    tableReturnOrderSupplierOrder.clear().draw(false);
    resetModalReturnOrderSupplierOrder();
    countCharacterTextarea()
}

function resetModalReturnOrderSupplierOrder() {
    $('#branch-return-order-supplier-order').text('---');
    $('#code-return-order-supplier-order').text('---');
    $('#employee-return-order-supplier-order').text('---');
    $('#supplier-return-order-supplier-order').text('---');
    $('#employee-delivery-return-order-supplier-order').text('---');
    $('#time-return-order-supplier-order').text(moment().format('DD/MM/YYYY'));
    $('#date-return-order-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#create-return-order-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#employee-received-return-order-supplier-order').text('---');
    $('#note-return-order-supplier-order').val('');
    $('#total-amount-return-order-supplier-order').text(0);
    $('#discount-return-order-supplier-order').text(0);
    $('#vat-return-order-supplier-order').text(0);
    $('.reset-discount-price').removeClass('d-none');
}
