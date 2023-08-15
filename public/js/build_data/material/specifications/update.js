let checkSaveUpdateSpecificationsData = 0 ,
    thisUpdateSpecificationsData = '',
    checkSaveUpdateBookingBonusData,
    oldDataUpdateSpecificationsData;

async function openModalUpdateSpecificationsData(r) {
    checkSaveUpdateBookingBonusData = 0;
    let id = r.data('id');
    thisUpdateSpecificationsData = r;
    $('#modal-update-specifications-data').modal('show');
    $('#value-name-update-specifications-data').val(null).trigger('change.select2');
    $('#value-name-update-specifications-data').select2({
        dropdownParent: $('#modal-update-specifications-data'),
    });
    $('#value-name-update-specifications-data').prop('disabled', true);
    $('#value-name-update-specifications-data ~ span').children().children().not('.select2-selection__rendered').addClass('disabled');
    $(document).on('select2:opening.disabled', ':disabled', function() {
        return false;
    });
    shortcut.add('F4', function () {
        saveModalUpdateSpecificationsData();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateSpecificationsData();
    });
    $('#name-update-specifications-data, #value-exchange-update-specifications-data').on('change', function () {
        let name = $('#name-update-specifications-data').val(),
            value_ex = $('#value-exchange-update-specifications-data').val(),
            name_ex = $('#value-name-update-specifications-data').find(':selected').text();
        $('#code-update-specifications-data').text(name + ' = ' + value_ex + name_ex);
    });
    $('#value-name-update-specifications-data').on('select2:select', function () {  z
        let name = $('#name-update-specifications-data').val(),
            value_ex = $('#value-exchange-update-specifications-data').val(),
            name_ex = $('#value-name-update-specifications-data').find(':selected').text();
        $('#code-update-specifications-data').text(name + ' = ' + value_ex + name_ex);
    });
    $('#value-exchange-update-specifications-data').on('click', function () {
        focusTextInput($(this));
    });
    $('#id-update-specifications-data').text(id);
    dataUpdateUpdateSpecificationsData(id);
}

async function dataUpdateUpdateSpecificationsData(id) {
    let url = 'specifications-data.data-update',
        method = 'get',
        params = {
            id: id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#value-name-update-specifications-data')]);
    oldDataUpdateSpecificationsData = res.data[0];
    $('#name-update-specifications-data').val(res.data[0].name);
    $('#value-name-update-specifications-data').html(res.data[0].specifications);
    $('#value-exchange-update-specifications-data').val(formatNumber(res.data[0].exchange_value));
    $('#status-update-specifications-data').text(res.data[0].status);
    $('#code-update-specifications-data').text(res.data[0].note);
}

async function saveModalUpdateSpecificationsData() {
    if(!checkValidateSave($('#modal-update-specifications-data'))) return false;
    if (checkSaveUpdateBookingBonusData === 1) return false;
    let name = $('#name-update-specifications-data').val(),
        value_ex = removeformatNumber($('#value-exchange-update-specifications-data').val()),
        name_ex = $('#value-name-update-specifications-data').val(),
        status = $('#status-update-specifications-data').text(),
        id = $('#id-update-specifications-data').text();
    checkSaveUpdateSpecificationsData = 1;
    let url = 'specifications-data.update',
        method = 'post',
        params = null,
        data = {
            id: id,
            name: name,
            status: status,
            value_ex: value_ex,
            name_ex: name_ex,
        };
    let text = $('#success-update-data-to-server').text();
    if (data.name == oldDataUpdateSpecificationsData.name
        && data.value_ex == oldDataUpdateSpecificationsData.exchange_value) {
        SuccessNotify(text);
        closeModalUpdateSpecificationsData();
        checkSaveUpdateBookingBonusData = 0;
        return
    }
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-specifications-data')]);
    checkSaveUpdateBookingBonusData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify(text);
            let data = {
                'DT_RowIndex' : thisUpdateSpecificationsData.parents('tr').find('td:eq(0)').text(),
                'name' : res.data.data.name,
                'exchange_value' : res.data.data.exchange_value,
                'material_unit_specification_exchange_name' : res.data.data.material_unit_specification_exchange_name,
                'action' : res.data.data.action,
                'keysearch' : res.data.data.keysearch,
            }
            updateRowDatatableTemplate(dataTableSpecificationsEnable, thisUpdateSpecificationsData, data);
            closeModalUpdateSpecificationsData();
        break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalUpdateSpecificationsData() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-update-specifications-data').modal('hide');
    reloadModalUpdateSpecificationsData();
}

function reloadModalUpdateSpecificationsData() {
    removeAllValidate();
    $('#modal-update-specifications-data input').val('');
    $('#value-exchange-update-specifications-data').val(1);
    $('#code-update-specifications-data').val('');
    $('#value-name-update-specifications-data').val('').trigger('change.select2');
}
