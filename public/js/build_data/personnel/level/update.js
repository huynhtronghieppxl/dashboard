let checkSaveEditLevelData;
async function openModalUpdateLevelData(r) {
    checkSaveEditLevelData = 0;
    $('#modal-update-level-data').modal('show');
    $('#select-role-update-level-data').select2({
        dropdownParent: $('#modal-update-level-data'),
    });
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalUpdateLevelData()
    });
    shortcut.add('F4', function () {
        saveModalUpdateLevelData();
    });

    $('#id-update-level-data').text(r.data('id'));
    $('#name-update-level-data').val(r.data('name'));
    $('#table-update-level-data').val(r.data('table'));
    $('#value-update-level-data').val(r.data('value'));
    $('#description-update-level-data').val(r.data('description'));
    $('#select-role-update-level-data').val(r.data('role')).trigger('change.select2');
    countCharacterTextarea()
}

async function saveModalUpdateLevelData() {
    if (checkSaveEditLevelData === 1) return false;
    if (!checkValidateSave($('#modal-update-level-data'))) return false;
    let id = $('#id-update-level-data').text();
    let role = $('#select-role-update-level-data').val();
    let table = removeformatNumber($('#table-update-level-data').val());
    let value = removeformatNumber($('#value-update-level-data').val());
    let name = $('#name-update-level-data').val();
    let description = $('#description-update-level-data').val();
    checkSaveEditLevelData = 1;
    let method = 'post',
        url = 'level-data.update',
        params = null,
        data = {id: id, role: role, table: table, value: value, name: name, description: description, brand : $('.select-brand.level-data').val()};
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-level-data')]);
    checkSaveEditLevelData = 0;
    let text = '';
    switch (res.data.status ) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            dataLevelData();
            closeModalUpdateLevelData();
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function () {
                openModalCreateLevelData()
            })
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

function closeModalUpdateLevelData() {
    $('#modal-update-level-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateLevelData()
    })
    resetModalUpdateLevelData();
    countCharacterTextarea()
}

function resetModalUpdateLevelData(){
    removeAllValidate();
    $('#name-update-level-data').val('');
    $('#table-update-level-data').val('0');
    $('#value-update-level-data').val('0');
    $('#description-update-level-data').val('');
}
