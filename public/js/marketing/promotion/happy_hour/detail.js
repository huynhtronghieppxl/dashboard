function openModalDetailHappyHourPromotion(r) {
    $('#modal-detail-happy-hour-promotion-data').modal('show');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalDetailHappyHourPromotion();
    });
    $('#note-detail-happy-hour-promotion').text(r.data('note'));
}

function closeModalDetailHappyHourPromotion() {
    $('#modal-detail-happy-hour-promotion-data').modal('hide');
}
