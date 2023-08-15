let checkSaveCreateSpecificationsData = 0;

function openModalCreateSpecificationsMaterialData() {
    if ($('#unit-create-material-data').find(':selected').val() === '-1' || $('#unit-create-material-data').find(':selected').val() === undefined) {
        let text = 'Vui lòng chọn đơn vị trước khi tạo thêm quy cách !';
        ErrorNotify(text);
        return false;
    }
    addLoading('material-data.create-specifications', '#loading-modal-create-specifications-material-data');
    $('#value-name-create-specifications-material-data').select2({
        dropdownParent: $('#modal-create-specifications-material-data'),
        theme: 'material'
    });
    $('#modal-create-specifications-material-data').modal('show');
    shortcut.add('F4', function () {
        saveModalCreateSpecificationsMaterialData();
    });
    shortcut.add('ESC', function () {
        closeModalCreateSpecificationsMaterialData();
    });
    $('#value-exchange-create-specifications-material-data').val(1);
    $('#name-create-specifications-material-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#value-exchange-create-specifications-material-data').select();
        }
    });
    $('#value-exchange-create-specifications-material-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#value-name-create-specifications-material-data').select2('open');
        }
    });
    $('#name-create-specifications-material-data, #value-exchange-create-specifications-material-data').on('input', function () {
        let name = $('#name-create-specifications-material-data').val(),
            value_ex = $('#value-exchange-create-specifications-material-data').val(),
            name_ex = $('#value-name-create-specifications-material-data').find(':selected').text();
        $('#code-create-specifications-material-data').text(name + ' = ' + value_ex + name_ex);
    });
    $('#value-name-create-specifications-material-data').on('select2:select', function () {
        let name = $('#name-create-specifications-material-data').val(),
            value_ex = $('#value-exchange-create-specifications-material-data').val(),
            name_ex = $('#value-name-create-specifications-material-data').find(':selected').text();
        $('#code-create-specifications-material-data').text(name + ' = ' + value_ex + name_ex);
    });
    dataServerCreateSpecificationsData();
}

async function dataServerCreateSpecificationsData() {
    let url = 'specifications-data.data-server',
        method = 'get',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#value-name-create-specifications-material-data')]);
    $('#value-name-create-specifications-material-data').html(res.data[0]);
}

async function saveModalCreateSpecificationsMaterialData() {
    if (checkSaveCreateSpecificationsData !== 0) {
        return false;
    }
    let name = $('#name-create-specifications-material-data').val(),
        unit = $('#unit-create-material-data').val(),
        value_ex = removeformatNumber($('#value-exchange-create-specifications-material-data').val()),
        name_ex = $('#value-name-create-specifications-material-data').val();
    checkSaveCreateSpecificationsData = 1;
    let url = 'material-data.create-specifications',
        method = 'post',
        params = null,
        data = {
            name: name,
            name_ex: name_ex,
            value_ex: value_ex,
            unit: unit
        };
    let res = await axiosTestTemplate(method, url, params, data, [$('#load-modal-body-create-specifications-material-data')]);
    checkSaveCreateSpecificationsData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalCreateSpecificationsMaterialData();
            dataSpecificationsCreateMaterialData();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalCreateSpecificationsMaterialData() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-create-specifications-material-data').modal('hide');
    reloadModalCreateSpecificationMaterialData();
}

function reloadModalCreateSpecificationMaterialData(){
    removeAllValidate();
    $('#modal-create-specifications-material-data input').val('');
    $('#code-create-specifications-material-data').text('');
}
