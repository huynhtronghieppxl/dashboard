function closeModalNotifyMaterialData(){
    $('#modal-notify-change-status-material').modal('hide')
    shortcut.remove('ESC');
}

function openModalNotifyMaterialData(){
    $('#modal-notify-change-status-material').modal('show')
    $('#table-change-status-enable-material-food-data').addClass('d-none')
    $('#table-change-status-enable-material-order-data').addClass('d-none')

    shortcut.add('ESC', function () {
        closeModalNotifyMaterialData();
    });
}
