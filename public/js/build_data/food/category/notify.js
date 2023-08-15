function closeModalNotifyFoodCategoryData(){
    $('#modal-notify-change-status-food-category').modal('hide')
    shortcut.remove('ESC');
}

function openModalNotifyFoodCategoryData(){
    $('#modal-notify-change-status-food-category').modal('show')
    shortcut.add('ESC', function () {
        closeModalNotifyFoodCategoryData();
    });
}
