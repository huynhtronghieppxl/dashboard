function openModalDetailReceiptsBill(id, branch) {
    $('#modal-detail-receipts-bill').modal('show');
    dataDetailReceiptsBill(id, branch);
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailReceiptsBill();
    });
}

async function dataDetailReceiptsBill(id, branch) {
    let method = 'get',
        url = 'receipts-bill-treasurer.detail',
        params = {id: id, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-detail-receipts-bill')]);
    $('#code-detail-receipts-bill').text(res.data[0].code);
    $('#branch-detail-receipts-bill').text(res.data[0].branch.name);
    $('#date-detail-receipts-bill').text(res.data[0].fee_month.slice(0,10));
    $('#create-employee-name-detail-receipts-bill').text(res.data[0].employee.name);
    $('#create-employee-avatar-detail-receipts-bill').attr('src', res.data[0].employee.avatar);
    $('#update-employee-name-detail-receipts-bill').text(res.data[0].employee_edit.name);
    $('#update-employee-avatar-detail-receipts-bill').attr('src', res.data[0].employee_edit.avatar);
    $('#confirm-employee-name-detail-receipts-bill').text(res.data[0].employee_confirm.name);
    $('#confirm-employee-avatar-detail-receipts-bill').attr('src', res.data[0].employee_confirm.avatar);
    $('#date-create-detail-receipts-bill').text(res.data[0].created_at);
    $('#date-update-detail-receipts-bill').text(res.data[0].updated_at);
    $('#date-confirm-detail-receipts-bill').text(res.data[0].fee_month);
    $('#type-detail-receipts-bill').text(res.data[0].addition_fee_reason_name);
    $('#amount-detail-receipts-bill').text(formatNumber(res.data[0].amount));
    $('#object-name-detail-receipts-bill').text(res.data[0].object_name);
    $('#count-detail-receipts-bill').text(res.data[0].is_count_to_revenue_name);
    $('#type-auto-detail-receipts-bill').text(res.data[0].is_automatically_generated_name);
    if (res.data[0].object_type_id === 4) {
        $('#div-object-id-detail-receipts-bill').removeClass('d-none');
        $('#object-id-detail-receipts-bill').html('<a href="javascript:void(0)" class="text-primary" onclick="openBillDetail(' + res.data[0].object_id + ')">#' + res.data[0].object_id + '</a>');
    } else {
        $('#div-object-id-detail-receipts-bill').addClass('d-none');
        $('#object-id-detail-receipts-bill').html('<label>#' + res.data[0].object_id + '</label>');
    }
    if(res.data[0].addition_fee_status === 3){
        $('#cancel-detail-receipts-bill').removeClass('d-none')
    }
    else{
        $('#cancel-detail-receipts-bill').addClass('d-none')
    }
    $('#note-detail-receipts-bill').text(res.data[0].note === '' ? '---' : res.data[0].note);
    res.data[0].addition_fee_status !== 3 ?  $('#cancel-reason-detail-receipts-bill-div').addClass('d-none') : $('#cancel-reason-detail-receipts-bill-div').removeClass('d-none')
    $('#cancel-reason-detail-receipts-bill').text(res.data[0].cancel_reason === '' ? '---' : res.data[0].cancel_reason);
    $('#status-detail-receipts-bill').html(res.data[0].status);
    if(res.data[0].object_type === 4 && res.data[0].is_addition_vat === 1){
        $('#object-type-detail-receipts-bill').text('Thu VAT tay');
    }else{
        $('#object-type-detail-receipts-bill').text(res.data[0].object_type_text);
    }
}

function closeModalDetailReceiptsBill() {
    $('#modal-detail-receipts-bill').modal('hide');
    resetModalDetailReceiptsBill();
}

function resetModalDetailReceiptsBill(){
    $('#div-object-id-detail-receipts-bill').removeClass('d-none');
    $('#code-detail-receipts-bill').text('---');
    $('#branch-detail-receipts-bill').text('---');
    $('#date-detail-receipts-bill').val(moment().format('DD/MM/YYYY'));
    $('#create-employee-name-detail-receipts-bill').text('---');
    $('#create-employee-avatar-detail-receipts-bill').attr('---');
    $('#update-employee-name-detail-receipts-bill').text('---');
    $('#update-employee-avatar-detail-receipts-bill').attr('---');
    $('#confirm-employee-name-detail-receipts-bill').text('---');
    $('#confirm-employee-avatar-detail-receipts-bill').attr('---');
    $('#date-create-detail-receipts-bill').val(moment().format('DD/MM/YYYY'));
    $('#date-update-detail-receipts-bill').val(moment().format('DD/MM/YYYY'));
    $('#date-confirm-detail-receipts-bill').val(moment().format('DD/MM/YYYY'));
    $('#type-detail-receipts-bill').text('---');
    $('#amount-detail-receipts-bill').text('0');
    $('#object-name-detail-receipts-bill').text('---');
    $('#count-detail-receipts-bill').text('---');
    $('#type-auto-detail-receipts-bill').text('---');
    $('#object-type-detail-receipts-bill').text('---');
    $('#note-detail-receipts-bill').text('---');
    $('#status-detail-receipts-bill').html('---');
    $('#object-id-detail-receipts-bill').html('---');
}
