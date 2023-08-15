function closeModalNotifyAssignKitchenData(){
    $('#modal-notify-change-status-assign-kitchen').modal('hide')
    shortcut.remove('ESC');
}

function openModalNotifyAssignKitchenData(){
    $('#modal-notify-change-status-assign-kitchen').modal('show')

    shortcut.add('ESC', function () {
        closeModalNotifyAssignKitchenData();
    });
}
