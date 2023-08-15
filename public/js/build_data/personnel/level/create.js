let checkSaveCreateLevelData;

function openModalCreateLevelData() {
    checkSaveCreateLevelData = 0;
    $('#modal-create-level-data').modal('show');
    $('#modal-create-level-data').on('shown.bs.modal', function () {
        $('#name-create-level-data').focus();
    });
    $('#select-role-create-level-data').select2({
        dropdownParent: $('#modal-create-level-data'),
    });
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalCreateLevelData()
    });
    shortcut.add('F4', function () {
        saveModalCreateLevelData();
    });
    $("#modal-create-level-data input").on("click", function () {
        $(this).select();
    });
    $('#modal-create-level-data').focus();
    $('#select-role-create-level-data').val($('#table-role-level-data tbody tr.selected').find('td:eq(1)').find('input').val()).trigger('change.select2');
    $('#loading-modal-create-level-data input, #loading-modal-create-level-data textarea').on('input', function (){
        $('#modal-create-level-data  .btn-renew').removeClass('d-none');
    });
    $('#loading-modal-create-level-data select').on('change', function (){
        $('#modal-create-level-data .btn-renew').removeClass('d-none');
    });
    $('#modal-create-level-data .btn-renew').on('click', function (){
        $('#modal-create-level-data .btn-renew').addClass('d-none')
    });
    $('#loading-modal-create-level-data .form-validate-input, #loading-modal-create-level-data .form__group').on('click', function (){
        $(this).addClass('focus-validate');
    })
}

async function saveModalCreateLevelData() {
    if ( checkSaveCreateLevelData === 1) return false;
    if (!checkValidateSave($('#modal-create-level-data'))) return false;
    let role = $('#select-role-create-level-data').val();
    let table = removeformatNumber($('#table-create-level-data').val());
    let value = removeformatNumber($('#value-create-level-data').val());
    let name = $('#name-create-level-data').val();
    let description = $('#description-create-level-data').val();
    checkSaveCreateLevelData = 1;
    let method = 'post',
        url = 'level-data.create',
        params = null,
        data = {role: role, table: table, value: value, name: name, description: description, brand : $('.select-brand.level-data').val()};
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-level-data')]);
    checkSaveCreateLevelData = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            dataLevelData();
            closeModalCreateLevelData();
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function (){
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

function closeModalCreateLevelData() {
    $('#modal-create-level-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateLevelData()
    })
    reloadModalCreateLevelData();
    countCharacterTextarea()
}

function reloadModalCreateLevelData(){
    removeAllValidate();
    $('#select-role-create-level-data').val($('#select-role-create-level-data').find('option:first-child').val()).trigger('change.select2');
    $('#name-create-level-data').val('');
    $('#table-create-level-data').val(0);
    $('#value-create-level-data').val(0);
    $('#description-create-level-data').val('');
    $('#modal-create-level-data .btn-renew').addClass('d-none')
}
