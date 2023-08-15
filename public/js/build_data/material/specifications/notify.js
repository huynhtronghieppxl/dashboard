function closeModalNotifySpecificationData(){
    $('#modal-notify-change-status-speification').modal('hide')
    shortcut.remove('ESC');
}

function openModalNotifySpecificationData(){
    $('#modal-notify-change-status-speification').modal('show')
    shortcut.add('ESC', function () {
        closeModalNotifySpecificationData();
    });
}
