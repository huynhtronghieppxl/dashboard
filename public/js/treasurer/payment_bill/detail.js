 function openModalDetailPaymentBill(id, branch) {
    $('#modal-detail-payment-bill').modal('show');
    $('#div-inventory-detail-payment-bill').addClass('d-none');
    dataDetailPaymentBill(id, branch);
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailPaymentBill();
    });
    $('#modal-detail-order-supplier-order').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailPaymentBill();
        });
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailOrderSupplierOrder();
        });
    });
}

async function dataDetailPaymentBill(id, branch) {
    let method = 'get',
        url = 'payment-bill-treasurer.detail',
        params = {id: id, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-detail-payment-bill')]);
    $('#code-detail-payment-bill').text(res.data[0].code);
    $('#branch-detail-payment-bill').text(res.data[0].branch.name);
    $('#date-detail-payment-bill').text(res.data[0].fee_month.slice(0,10));
    $('#date-create-detail-payment-bill').text(res.data[0].created_at);
    $('#create-employee-name-detail-payment-bill').text(res.data[0].employee.name);
    $('#create-employee-avatar-detail-payment-bill').attr('src', res.data[0].employee.avatar);
    if(res.data[0].addition_fee_status !== 7){
        $('#confirm-detail-payment-bill-div').removeClass('d-none')
    }else{
        $('#confirm-detail-payment-bill-div').addClass('d-none')
    }
    if(res.data[0].addition_fee_status === 3){
        $('#cancel-reason-detail-payment-bill-div').removeClass('d-none')
        $('#cancel-employee-detail-payment-bill').removeClass('d-none')
        $('#confirm-employee-detail-payment-bill').addClass('d-none')
        $('#date-confirm-detail-payment-bill').text(res.data[0].updated_at);
    }else{
        $('#cancel-reason-detail-payment-bill-div').addClass('d-none')
        $('#cancel-employee-detail-payment-bill').addClass('d-none')
        $('#confirm-employee-detail-payment-bill').removeClass('d-none')
        $('#date-confirm-detail-payment-bill').text(res.data[0].updated_at);
    }
    if (res.data[0].updated_at !== "") {
        $('#date-update-detail-payment-bill').text(res.data[0].updated_at);
        $('#update-employee-name-detail-payment-bill').text(res.data[0].employee_edit.name);
        $('#update-employee-avatar-detail-payment-bill').attr('src', res.data[0].employee_edit.avatar);
        $('#div-update-detail-payment-bill').removeClass('d-none');
    }
    if (res.data[0].fee_month !== "") {
        $('#confirm-employee-name-detail-payment-bill').text(res.data[0].employee_confirm.name);
        $('#confirm-employee-avatar-detail-payment-bill').attr('src', res.data[0].employee_confirm.avatar);
        $('#div-confirm-detail-payment-bill').removeClass('d-none');
    }

    $('#type-detail-payment-bill').text(res.data[0].addition_fee_reason_name);
    $('#amount-detail-payment-bill').text(formatNumber(res.data[0].amount));
    $('#object-name-detail-payment-bill').text(res.data[0].object_name);
    $('#count-detail-payment-bill').text(res.data[0].is_count_to_revenue_name);
    if (res.data[0].object_type_text === '') {
        $('#object-type-detail-payment-bill').text('')
    } else {
        $('#object-type-detail-payment-bill').text(res.data[0].object_type_text);
    }
    $('#note-detail-payment-bill').text(res.data[0].note == '' ? '---' : res.data[0].note)
    if($('#level-template').val() > 0) {
        $('#box-fund-payment-bill-treasurer').removeClass('d-none');
        $('#fund-payment-bill-treasurer').text(moment(res.data[0].cash_flow_time, "DD/MM/YYYY HH:mm:ss").format('MM/YYYY'))
    }else {
        $('#box-fund-payment-bill-treasurer').addClass('d-none');
    }
    $('#cancel-reason-detail-payment-bill').text(res.data[0].cancel_reason)
    $('#status-detail-payment-bill').html(res.data[0].status_text);
    $('#div-inventory-detail-payment-bill').addClass('d-none');
    if (res.data[0].object_type === 1) {
        $('#div-inventory-detail-payment-bill').removeClass('d-none');
        warehouseSessionDetail(res.data[1].original.data);
        $('#total-amount-detail-payment-bill').text(formatNumber(res.data[3].total_amount_supplier_orders))
    }
}

async function warehouseSessionDetail(data) {
    let id = $('#table-inventory-detail-payment-bill'),
        scroll_Y = '40vh',
        fixedLeft = 2,
        fixedRight = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', className: 'text-center'},
            {data: 'received_at', className: 'text-center'},
            {data: 'supplier_name', className: 'text-center'},
            // {data: 'category_type_name', className: 'text-center d-none'},
            {data: 'total_amount', className: 'text-center'},
            {data: 'retention_money', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ], option =[];
    let tableInventoryDetailPaymentBill = await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight,option);
    $(document).on('input paste keyup', '#table-inventory-detail-payment-bill_filter', async function () {
        let totalAmountInventoryDetailPaymentBill = searchTableListBill(tableInventoryDetailPaymentBill)
        $('#total-amount-detail-payment-bill').text(formatNumber(totalAmountInventoryDetailPaymentBill))
    })
 }

function searchTableListBill(datatable){
     let totalAmount = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find('td:eq(4)').text());
    })
     return totalAmount;
}

function closeModalDetailPaymentBill() {
    $('#modal-detail-payment-bill').modal('hide');
    resetModalDetailPaymentBill();
}
function resetModalDetailPaymentBill(){
    $('.reset-data-detail-payment-bill').text('---');
    $('#modal-detail-payment-bill img').attr('src', '');
    $('#code-detail-payment-bill').text('---');
    $('#date-detail-payment-bill').text(moment().format('DD/MM/YYYY'));
    $('#count-detail-payment-bill').text('---');
    $('#date-create-detail-payment-bill').text(moment().format('DD/MM/YYYY'));
    $('#branch-detail-payment-bill').text('---');
    $('#object-type-detail-payment-bill').text('---');
    $('#amount-detail-payment-bill').text('0');
    $('#date-update-detail-payment-bill').text(moment().format('DD/MM/YYYY'));
    $('#type-detail-payment-bill').text('---');
    $('#object-name-detail-payment-bill').text('---');
    $('#note-detail-payment-bill').text('---');
    $('#date-confirm-detail-payment-bill').text(moment().format('DD/MM/YYYY'));
}
