let checkSaveCreateKitchenData;


$(function () {
    shortcut.add('F2', function () {
        openModalCreateKitchenData();
    })
});

function openModalCreateKitchenData() {
    $('#modal-create-kitchen-data').modal('show');
    shortcut.remove("F2");
    shortcut.add('ESC', function () {
        closeModalCreateKitchenData();
    });
    shortcut.add('F4', function () {
        saveModalCreateKitchenData();
    })
    checkSaveCreateKitchenData = 0;
    $('#name-create-kitchen-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#description-create-kitchen-data').select();
        }
    });
    $('#select-type-print-create-kitchen-data').select2({
        dropdownParent: $('#modal-create-kitchen-data'),
    });
    $('#setting-printer').on('click', function () {
        $('#size-create-print-kitchen-data input[value=1]').prop('checked', true);
        if (Number($(this).is(':checked'))) {
            $('#box-setting-printer').removeClass('d-none');
            $('#select-type-print-machine').removeClass('d-none');
        } else {
            $('#box-setting-printer').addClass('d-none');
            $('#select-type-print-machine').addClass('d-none');
            $('#input-info-print-kitchen-data').addClass('d-none');
            $('#select-type-print-create-kitchen-data').val('').trigger('change.select2');
        }
    })
    $(document).on('change', '#select-type-print-create-kitchen-data', function () {
        if ($(this).find('option:selected').val() == 0) {
            $('#input-info-print-kitchen-data').removeClass('d-none')
        } else {
            $('#input-info-print-kitchen-data').addClass('d-none')
            $('#size-create-print-kitchen-data').find('.radio:last input').prop('checked', true);
        }
    })


    $('#description-create-kitchen-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#printer-name-create-kitchen-data').select();
        }
    });
    $('#printer-name-create-kitchen-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#printer-ip-create-kitchen-data').select();
        }
    });
    $('#printer-ip-create-kitchen-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#printer-port-create-kitchen-data').select();
        }
    });
    $('#printer-port-create-kitchen-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#printer-paper-size-create-kitchen-data').select();
        }
    });
    $('#status-create-print-kitchen-data input[value=0]').prop('checked', true);
    $('#size-create-print-kitchen-data input[value=80]').prop('checked', true);
    $('#modal-create-kitchen-data input, #modal-create-kitchen-data textarea').on('input', function () {
        $('#modal-create-kitchen-data .btn-renew').removeClass('d-none')
    })
    $('#modal-create-kitchen-data select').on('change', function () {
        $('#modal-create-kitchen-data .btn-renew').removeClass('d-none')
    })
}

async function saveModalCreateKitchenData() {
    if (checkSaveCreateKitchenData === 1) return false;
    if (!checkValidateSave($('#modal-create-kitchen-data'))) return false;
    let branch_id = $('.select-branch').val(),
        restaurant_brand_id = $('.select-brand').val(),
        name = $('#name-create-kitchen-data').val(),
        description = $('#description-create-kitchen-data').val(),
        printer_name = $('#printer-name-create-kitchen-data').val() == undefined ? '' : $('#printer-name-create-kitchen-data').val(),
        printer_ip_address = $('#printer-ip-create-kitchen-data').val() == undefined ? '' : $('#printer-ip-create-kitchen-data').val(),
        printer_port = removeformatNumber($('#printer-port-create-kitchen-data').val()),
        is_printer_paper = $('#size-create-print-kitchen-data').find('input[type="radio"]:checked').val(),
        is_print_each_food = Number($('#status-create-is-each-print-kitchen-data').is(':checked')),
        is_have_printer = $('input[name="status"]:checked').val(),
        type = $('#type-kitchen-create-kitchen-data :checked').val(),
        printer_type = $('#select-type-print-create-kitchen-data').val() == null ? '' : $('#select-type-print-create-kitchen-data').val();
    checkSaveCreateKitchenData = 1;
    if (!$('#setting-printer').is(':checked')) {
        printer_name = '';
        printer_ip_address = '';
        printer_port = '';
        is_printer_paper = '';
        is_have_printer = '';
        is_print_each_food = '';
    }
    let method = 'post',
        url = 'kitchen-data.create',
        params = null,
        data = {
            branch_id: branch_id,
            name: name,
            restaurant_brand_id: restaurant_brand_id,
            description: description,
            printer_name: printer_name,
            printer_ip_address: printer_ip_address,
            printer_port: printer_port,
            printer_paper_size: is_printer_paper,
            is_have_printer: is_have_printer,
            is_print_each_food: is_print_each_food,
            type: type,
            printer_type: printer_type,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#create-kitchen-modal')]);
    checkSaveCreateKitchenData = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            drawDataTableKitchen(res.data.data);
            closeModalCreateKitchenData();
            break;
        case 500:
            ErrorNotify(res.data.message);
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function drawDataTableKitchen(data) {
    addRowDatatableTemplate(dataTableKitchenEnable, {
        'name': data.name,
        'description': data.description,
        'type_text': data.type_text,
        'action': data.action,
        'keysearch': data.keysearch,
    });
    $('#total-record-enable-kitchen-data').text(Number(removeformatNumber($('#total-record-enable-kitchen-data').text())) + 1);
}

function closeModalCreateKitchenData() {
    removeAllValidate();
    shortcut.remove("F4");
    shortcut.remove("ESC");
    shortcut.add('F2', function () {
        openModalCreateKitchenData();
    })
    $('#modal-create-kitchen-data').modal('hide');
    resetModalCreateKitchenData();
    countCharacterTextarea()
}

function resetModalCreateKitchenData() {
    $('#box-setting-printer').addClass('d-none');
    $('#setting-printer').prop('checked', false);
    $('#name-create-kitchen-data').val('');
    $('#printer-name-create-kitchen-data').val('');
    $('#printer-ip-create-kitchen-data').val('');
    $('#printer-port-create-kitchen-data').val('');
    $('#modal-create-kitchen-data textarea').val('');
    $('#create-kitchen-modal').removeClass('d-none');
    $('#open-setting-printer-modal').removeClass('d-none');
    $('#close-setting-printer-modal').addClass('d-none');
    $('#size-create-print-kitchen-data input[value=1]').prop('checked', true);
    $('#status-create-is-each-print-kitchen-data').prop('checked', false);
    $('#size-create-print-kitchen-data input[value="1"]').prop('checked', true);
    $('#status-create-print-kitchen-data input[value="0"]').prop('checked', true);
    $('#modal-create-kitchen-data .btn-renew').addClass('d-none')
    $('#select-type-print-machine').addClass('d-none')
    $('#input-info-print-kitchen-data').addClass('d-none')
    $('#select-type-print-machine select').val('').trigger('change.select2')
}
