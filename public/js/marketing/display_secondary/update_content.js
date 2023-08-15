let checkSaveUpdateDisplaySecPos = 0;

function openModalUpdateDisplaySecPos() {
    getDataContentDisplaySecPos()
    $('#modal-update-content-display-secondary').modal('show');
    // addLoading('unit-food-data.update', '#loading-modal-update-content-display-secondary');
    shortcut.add('F4', function () {
        saveUpdateDisplaySecPos();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateDisplaySecPos();
    });
    $('#modal-update-content-display-secondary input').on('keyup', function () {
        $('#modal-update-content-display-secondary .btn-renew').removeClass('d-none')
    })
}
async function getDataContentDisplaySecPos() {
    let method = 'GET',
        url = 'display-secondary-pos.data-content',
        param = {brand_id: idBrandaddClass},
        data = null;
    let res = await axiosTemplate(method, url, param, data)
    $('#content-update-display-secondary-pos').val(res.data.data.sub_monitor_acknowledgements);
}
function resetModalUpdateDisplaySecPos() {
    removeAllValidate();
    $('#modal-update-content-display-secondary input').val('');
    $('#modal-update-content-display-secondary .btn-renew').addClass('d-none')
}
async function saveUpdateDisplaySecPos() {
    if ( checkSaveUpdateDisplaySecPos !== 0) return false;
    console.log(111111)
    if(!checkValidateSave($('#modal-update-content-display-secondary'))) return false
    let content = $('#content-update-display-secondary-pos').val();
    checkSaveUpdateDisplaySecPos = 1;
    let method = 'post',
        url = 'display-secondary-pos.create-content',
        params = {brand_id: idBrandaddClass},
        data = {content: content};
    let res = await axiosTemplate(method, url, params, data);
    checkSaveUpdateDisplaySecPos = 0;
    let text = '';
    switch (res.data.status ) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            closeModalUpdateDisplaySecPos()
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function closeModalUpdateDisplaySecPos() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    removeAllValidate();
    $('#modal-update-content-display-secondary').modal('hide');
    $('#content-update-display-secondary-pos').val('');
}


