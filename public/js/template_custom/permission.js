async function openModalDetailPermissionTemplate(id) {
    // await $('#table-permission-data input[type=checkbox]').each(function (i, v) {
    //     if (parseInt($(this).val()) === id) {
    //         $(this).click();
    //         return false;
    //     }
    // });
    let name = $('#detail-pri-'+id).data('name'),
        content = $('#detail-pri-'+id).data('des');
    $('#title-modal-detail-permission-template').html(name);
    $('#content-modal-detail-permission-template').html(content);
    $('#modal-detail-permission-template').modal('show')
}

function closeModalDetailPermissionTemplate() {
    $('#modal-detail-permission-template').modal('hide')
}
