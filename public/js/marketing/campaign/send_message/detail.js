function openModalDetailSendMessage(r){
    $('#modal-detail-send-message').modal('show');
    dataDetailSendMessage(r);
    shortcut.add('ESC', function () {
        closeModalDetailSendMessage();
    });
}

async function dataDetailSendMessage(r){
    let method = 'get',
        url = 'send-message-campaign.detail',
        params = {id: r.data('id')},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-detail-send-message')]);
    $('#image-gift-detail-send-message-campaign').html(res.data.data.message_url);
    $('#receiver-detail-send-message').text(res.data.data.customer.name);
    $('#title-detail-send-message').text(res.data.data.title);
    $('#content-detail-send-message').html(res.data.data.content);
    $('#name-gift-detail-send-message').text(res.data.data.restaurant_gift.name);
    $('#des-gift-detail-send-message').html(res.data.data.restaurant_gift.description);
    $('#quantity-detail-send-message').text(res.data.data.restaurant_gift.gift_object_quantity);
    $('#created-at-detail-send-message').text(res.data.data.restaurant_gift.created_at);
    $('#sent-at-detail-send-message').text(res.data.data.send_notification_at);
    $('#restaurant-at-detail-send-message').text(res.data.data.restaurant_brand_name);
    if(res.data.data.status === 3) {
        $('#reason-cancel-send-message').text(res.data.data.reason ? res.data.data.reason : '---');
        $('#reason-cancel-send-message').parents('.col-md-12').removeClass('d-none');
    }else {
        $('#reason-cancel-send-message').text('');
        $('#reason-cancel-send-message').parents('.col-md-12').addClass('d-none');
    }
}

function closeModalDetailSendMessage() {
    $('#modal-detail-send-message').modal('hide');
    resetModalDetailSendMessage();
}

function resetModalDetailSendMessage() {
    $('#modal-detail-kitchen-data h6').text('---');
    $('#modal-detail-kitchen-data p').text('---');
}
