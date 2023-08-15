
function openModalDetailWorkData(r) {
    $('#modal-detail-work-data').modal('show');
    shortcut.add('ESC', function () {
        closeModalDetailWorkData();
    });
    $('#data-detail-work-data').html(r.parents('.sortable-moves').find('span label').text());
}

function closeModalDetailWorkData() {
    $('#modal-detail-work-data').modal('hide');
}


