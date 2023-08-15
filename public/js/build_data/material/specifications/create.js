let loadDataCreateSpecificationsData = 0,
    checkSaveCreateSpecificationsData;

$(function () {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateSpecificationsData();
    });
})


function openModalCreateSpecificationsData() {
    checkSaveCreateSpecificationsData = 0;
    $('#modal-create-specifications-data').modal('show');
    $('#value-name-create-specifications-data').select2({
        dropdownParent: $('#modal-create-specifications-data'),
    });

    $('#name-create-specifications-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#value-exchange-create-specifications-data').select();
        }
    });
    $('#value-exchange-create-specifications-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#value-name-create-specifications-data').select2('open');
        }
    });
    $('#name-create-specifications-data, #value-exchange-create-specifications-data').on('input', function () {
        let name = $('#name-create-specifications-data').val(),
            value_ex = $('#value-exchange-create-specifications-data').val(),
            name_ex = $('#value-name-create-specifications-data').find(':selected').text();
        $('#code-create-specifications-data').text(name + ' = ' + value_ex + name_ex);
    });
    $('#value-name-create-specifications-data').on('select2:select', function () {
        $('.select-material-box .line').css('border','1.5px solid #a3a1a1 !important');
        let name = $('#name-create-specifications-data').val(),
            value_ex = $('#value-exchange-create-specifications-data').val(),
            name_ex = $('#value-name-create-specifications-data').find(':selected').text();
        $('#code-create-specifications-data').text(name + ' = ' + value_ex + name_ex);
    });
    $('#value-exchange-create-specifications-data').on('click', function () {
        focusTextInput($(this));
    });
    $('#modal-create-specifications-data input').on('input paste', function (){
        $('#modal-create-specifications-data .btn-renew').removeClass('d-none')
    })
    $('#modal-create-specifications-data select').on('change', function (){
        $('#modal-create-specifications-data .btn-renew').removeClass('d-none')
    })
    shortcut.add('F4', function () {
        saveModalCreateSpecificationsData();
    });
    shortcut.add('ESC', function () {
        closeModalCreateSpecificationsData();
    });
    dataServerCreateSpecificationsData();
}

async function dataServerCreateSpecificationsData() {
    if (loadDataCreateSpecificationsData === 0) {
        let url = 'specifications-data.data-server',
            method = 'get',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#value-name-create-specifications-data')]);
        loadDataCreateSpecificationsData = 1;
        $('#value-name-create-specifications-data').html(res.data[0]);
    }
}

async function saveModalCreateSpecificationsData() {
    if (checkSaveCreateSpecificationsData === 1) return false;
    if(!checkValidateSave($('#modal-create-specifications-data'))) return false;
    let name = $('#name-create-specifications-data').val(),
        value_ex = removeformatNumber($('#value-exchange-create-specifications-data').val()),
        name_ex = $('#value-name-create-specifications-data').val();
    checkSaveCreateSpecificationsData = 1;
    let url = 'specifications-data.create' ,
        method = 'post',
        params = null,
        data = {
            name: name,
            name_ex: name_ex,
            value_ex: value_ex,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-specifications-data')]);
    checkSaveCreateSpecificationsData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalCreateSpecificationsData();
            drawDataTableSpecifications(res.data.data)
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function drawDataTableSpecifications(data){
    addRowDatatableTemplate(dataTableSpecificationsEnable, {
        'name': data.name,
        'exchange_value': data.exchange_value,
        'material_unit_specification_exchange_name': data.material_unit_specification_exchange_name,
        'action':  data.action ,
        'keysearch':data.keysearch
    });
    $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
}

function closeModalCreateSpecificationsData() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateSpecificationsData();
    });
    $('#modal-create-specifications-data').modal('hide');
    resetModalCreateSpecificationsData();
}

function resetModalCreateSpecificationsData() {
    removeAllValidate();
    $('#modal-create-specifications-data input').val('');
    $('#value-exchange-create-specifications-data').val('1');
    $('#code-create-specifications-data').val('');
    $('#value-name-create-specifications-data').val('').trigger('change.select2');
    $('#modal-create-specifications-data .btn-renew').addClass('d-none');
}
