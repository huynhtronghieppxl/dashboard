let checkSaveCreateDisplaySecPos;
function openModalDisplaySecPos() {
    $('#modal-create-content-display-secondary-pos').modal('show');
    shortcut.add('F4', function () {
        saveModalCreateDisplaySecPos();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCreateDisplaySecPos();
    });
}
async function saveModalCreateDisplaySecPos() {
    if (checkSaveCreateDisplaySecPos === 1) return false;
    if (!checkValidateSave($('#modal-create-content-display-secondary-pos'))) return false;
    checkSaveCreateDisplaySecPos = 1;
    let content = $('#content-create-display-secondary-pos').val();
    let method = 'post',
        url = 'display-secondary-pos.create-content',
        params = {brand_id: idBrandaddClass},
        data = {content: content};
    let res = await axiosTemplate(method, url, params, data);
    checkSaveCreateDisplaySecPos = 0;
    let text = '';
    switch (res.data.status ) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalCreateDisplaySecPos();
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
function closeModalCreateDisplaySecPos() {
    removeAllShortcuts();
    $('#modal-create-content-display-secondary-pos').modal('hide');
    reloadModalCreateDisplaySecPos();
}

function reloadModalCreateDisplaySecPos() {
    removeAllValidate();
    $('#content-create-display-secondary-pos').val('');
}
