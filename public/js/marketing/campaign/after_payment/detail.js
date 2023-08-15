let typeDetailInCustomerMessage, idDetailCustomerMessage,contentDetailCustomerMessage;
function openModalDetailCustomerMessage(r) {
    $('#modal-detail-after-payment').modal('show');
    $('#modal-detail-after-payment').on('shown.bs.modal', function () {
        shortcut.remove('F4');
        shortcut.add('F4', function () {
            saveModalUpdateCustomerMessageData();
        });
        shortcut.add('ESC', function () {
            closeModalUpdateCustomerMessage();
        });
        idDetailCustomerMessage = r.attr('data-id');
        typeDetailInCustomerMessage = r.attr('data-type');
        branchIdUpdateInCustomerMessage = r.attr('data-branch-id');
        $('#name-branch-detail-after-payment').text(r.data('restaurant-brand-name'));
        $('#content-detail-after-payment').text(r.data('content'));
        $('#create-at-detail-after-payment').text(r.data('create'));
        switch (typeDetailInCustomerMessage) {
            case '2' :
                $('#type-detail-after-payment').text('Thông báo sinh nhật');
                break;
            case '1' :
                $('#type-detail-after-payment').text('Thông báo sau bữa ăn');
                break;
            case '3' :
                $('#type-detail-after-payment').text('Thông báo đăng ký thẻ thành viên thành công');
                break;
            case '4' :
                $('#type-detail-after-payment').text('Thông báo lên cấp thẻ thành viên');
                break;
            case '5' :
                $('#type-detail-after-payment').text('Thông báo được cộng điểm vào thẻ (nạp, tích lũy, khuyến mãi)');
                break;
        }
        $('#modal-detail-after-payment').find('#char-count > span:eq(0)').text($('#content-update-after-payment-campaign-data').val().length);
    });
}

function closeModalDetailCustomerMessage() {
    $('#modal-detail-after-payment').modal('hide');
    $('#modal-detail-after-payment').on('hidden.bs.modal', function () {
        shortcut.remove('F4');
        shortcut.remove('ESC');
        shortcut.add("F2", function () {
            openModalCreateCustomerMessage();
        });
    });
}
