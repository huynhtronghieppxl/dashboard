let idUpdateRoleData,
    checkSaveUpdateRoleData;

function openModalUpdateRoleData(r) {
    $('#modal-update-role-data').modal('show');
    addLoading('role-data.update', '#loading-modal-update-role-data');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalUpdateRoleData();
    });
    shortcut.add('F4', function () {
        saveModalUpdateRoleData()
    });
    $('#select-role-update-role-data, #select-group-update-role-data').select2({
        dropdownParent: $('#modal-update-role-data'),
    });
    checkSaveUpdateRoleData = 0;
    idUpdateRoleData = r.data('id');
    $('#name-update-role-data').val(r.data('name'));
    $('#select-role-update-role-data').val(r.data('role')).trigger('change.select2');
    if ($('#select-role-update-role-data').val() == null){
        $('#select-role-update-role-data').val(null).trigger('change.select2');
    }
    $('#description-update-role-data').val(r.data('description'));
    $('#select-group-update-role-data').val(r.data('type')).trigger('change.select2');
    if ($('#select-group-update-role-data').val() == null){
        $('#select-group-update-role-data').val(null).trigger('change.select2');
    }
}

async function saveModalUpdateRoleData() {
    if (checkSaveUpdateRoleData !== 0) {
        return false;
    }
    if(!checkValidateSave($('#modal-update-role-data'))) return false
    checkSaveUpdateRoleData = 1;
    let name = $('#name-update-role-data').val(),
        description = $('#description-update-role-data').val(),
        role = $('#select-role-update-role-data').val(),
        type = $('#select-group-update-role-data').val(),
        method = 'post',
        url = 'role-data.update',
        params = null,
        data = {
            id: idUpdateRoleData,
            name: name,
            role_manage: role,
            description: description,
            type : type
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-employee-manage')]);
    checkSaveUpdateRoleData = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            closeModalUpdateRoleData();

            loadData();
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

function closeModalUpdateRoleData() {
    $('#modal-update-role-data').modal('hide');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateRoleData()
    })
    shortcut.add('F4', function (){
        savePermissionRoleData()
    })
    reloadModalUpdateRoleData();
}

function reloadModalUpdateRoleData(){
    removeAllValidate();
    $('#name-update-role-data').val('');
    $('#description-update-role-data').val('');
}
