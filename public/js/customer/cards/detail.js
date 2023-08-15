function openModalDetailCard(r){
    $('#modal-detail-cards').modal('show');
    shortcut.remove('ESC');
    $('#modal-detail-cards').on('shown.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailCards();
        });
    });
    getDetailCardMembership(r);
}

async function getDetailCardMembership(r){
    let method = 'get',
        url = 'cards.detail',
        params = {
            id: r.data('id')
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, $('#modal-detail-cards'));
    $('#branch-detail-customer-card').text(res.data[0].branch_name);
    $('#name-customer-detail-customer-card').text(res.data[0].customer_name);
    $('#customer-phone-detail-customer-card').text(res.data[0].customer_phone);
    $('#card-name-detail-customer-card').text(res.data[0].restaurant_top_up_card_name);
    $('#total-detail-customer-card').text(formatNumber(res.data[0].amount));
    $('#bonus-detail-customer-card').text(formatNumber(res.data[0].bonus_amount));
    $('#total-amount-detail-customer-card').text(formatNumber(res.data[0].total_amount));
    $('#person-recharge-detail-customer-card').text(res.data[0].employee_create_name);
    $('#customer-update-detail-customer-card').text(res.data[0].employee_edit_name);
    $('#person-cancel-detail-customer-card').text(res.data[0].employee_cancel_name);
    $('#date-create-detail-customer-card').text(res.data[0].created_at);
    $('#date-update-detail-customer-card').text(res.data[0].updated_at);
    $('#date-cancel-detail-customer-card').text(res.data[0].updated_at);
    $('#reason-cancel-detail-customer-card').text(res.data[0].cancel_reason);
    $('#date-recharge-detail-customer-card').text(res.data[1])
    $('#status-detail-cards').html(res.data[1]);
    if(res.data[0].employee_edit_name !== ''){
        $('.person-detail-update-card-div').removeClass('d-none');
    }
    if(res.data[0].request_status === 3){
        $('.person-detail-cancel-card-div').removeClass('d-none');
    }
    // res.data[0].top_up_at !== '' ? $('#date-recharge-detail-customer-card').text(res.data.data.top_up_at) : $('#date-recharge-detail-customer-card').text('---');
    if (res.data[0].top_up_at !== '') {
        $('#date-recharge-detail-customer-card-div').removeClass('d-none');
    } else {
        $('#date-recharge-detail-customer-card-div').addClass('d-none');
    }
}

function closeModalDetailCards(){
    $('#modal-detail-cards').modal('hide');
    $('#modal-detail-cards h6').text('---');
    $('.person-detail-cancel-card-div').addClass('d-none');
    $('.person-detail-update-card-div').addClass('d-none');
}
