function closeModalNotifyCostData(){
    $('#modal-notify-change-status-cost-data').modal('hide')
    shortcut.remove('ESC');
}

function openModalNotifyCostData(){
    $('#modal-notify-change-status-cost-data').modal('show')
    shortcut.add('ESC', function () {
        closeModalNotifyCostData();
    });
}
