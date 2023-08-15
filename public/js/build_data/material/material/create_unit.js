let checkSaveCreateUnitData = 0, loadSpecificationsUnitMaterialData;

function openModalCreateUnitMaterialData() {
    $('#modal-create-unit-material-data').modal('show');
    addLoading('unit-data.create', '#loading-modal-create-unit-material-data');
    addLoading('unit-data.specifications', '#loading-modal-create-unit-material-data');
    shortcut.add('F4', function () {
        saveModalCreateUnitMaterialData();
    });
    shortcut.add('ESC', function () {
        closeModalCreateUnitMaterialData();
    });
    checkSaveCreateUnitData = 0;
    $('#select-specifications-create-unit-material-data').select2({
        dropdownParent: $('#modal-create-unit-material-data'),
    });
    $('#modal-create-unit-material-data').on('shown.bs.modal', function () {
        $(this).find('input').eq(0).select();
    });
    $('#name-create-unit-material-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#select-specifications-create-unit-material-data').select2('open');
        }
    });
    $('#name-create-unit-material-data').on('input paste', function () {
        $('#code-create-unit-material-data').val(removeVietnameseStringLowerCase($(this).val().replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'')).toUpperCase());
    })
    $('#modal-create-unit-material-data').on('shown.bs.modal', function () {
        $(this).find('input:eq(0)').focus();
    });
    $('#modal-create-unit-material-data input').on('click', function () {
        $(this).select();
    })
    dataSpecificationsUnitMaterialData();
}

async function dataSpecificationsUnitMaterialData() {
    let url = 'unit-data.specifications',
        method = 'get',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-specifications-create-unit-material-data')]);
    $('#select-specifications-create-unit-material-data').html(res.data[0]);
    loadSpecificationsUnitMaterialData = res.data[0];
}

async function saveModalCreateUnitMaterialData() {
    if (checkSaveCreateUnitData !== 0) {
        return false;
    }
    let name = $('#name-create-unit-material-data').val(),
        code = $('#code-create-unit-material-data').text(),
        specifications = $('#select-specifications-create-unit-material-data').val(),
        description = $('#description-create-unit-material-data').val();
    checkSaveCreateUnitData = 1;
    let url = 'unit-data.create',
        method = 'post',
        params = null,
        data = {
            name: name,
            code: code,
            specifications: specifications,
            description: description,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#load-modal-body-create-unit-material-data')]);
    checkSaveCreateUnitData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalCreateUnitMaterialData();
            $('#unit-create-material-data').find('option:first').removeAttr('selected');
            $('#unit-create-material-data').append('<option selected value="' + res.data.data.id + '">' + res.data.data.name + '</option>')
            await dataSpecificationsCreateMaterialData()
            $('#specifications-create-material-data').select2('open');
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalCreateUnitMaterialData() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-create-unit-material-data').modal('hide');
    reloadModalCreateMaterial();
}

function reloadModalCreateMaterial(){
    removeAllValidate();
    $('#name-create-unit-material-data').val('');
    $('#description-create-unit-material-data').val('');
    $('#code-create-unit-material-data').text('');
}
