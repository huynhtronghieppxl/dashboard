let checkSaveUpdateKitchenData, printTypeUpdateKitchenData,
    thisUpdateKitchenData, idUpdateKitchen, nameKitchenUpdateKitchenData,dataTypeKitchenUpdate,descriptionKitchenUpdateKitchenData,
    isHavePrinterKitchenUpdateKitchenData,isPrintEachFoodKitchenUpdateKitchenData,printerIPAddressKitchenUpdateKitchenData,printerNameKitchenUpdateKitchenData,
    printerPaperSizeKitchenUpdateKitchenData,printerPortKitchenUpdateKitchenData;

async function openModalUpdateKitchenData(r) {
    thisUpdateKitchenData = r;
    idUpdateKitchen = r.data('id');
    checkSaveUpdateKitchenData = 0;
    dataTypeKitchenUpdate = r.data('type');
    $('#modal-update-kitchen-data').modal('show');

    shortcut.remove("ESC");
    shortcut.remove("F2");

    $('#modal-update-kitchen-data').on('shown.bs.modal', function () {
        $('#name-update-kitchen-data').focus();
    })

    shortcut.add('F4', function () {
        saveModalUpdateKitchenData();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateKitchenData();
    });
    $('#name-update-kitchen-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#description-update-kitchen-data').select();
        }
    });
    $('#description-update-kitchen-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#printer-name-update-kitchen-data').select();
        }
    });
    $('.select-type-print-update-kitchen-data').select2({
        dropdownParent: $('#modal-update-kitchen-data'),
    });
    $('#printer-name-update-kitchen-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#printer-ip-update-kitchen-data').select();
        }
    });
    $('#printer-ip-update-kitchen-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#printer-port-update-kitchen-data').select();
        }
    });
    $(document).on('change', '.select-type-print-update-kitchen-data', function () {
        if ($(this).find('option:selected').val() == 0) {
            $('#inputs-type-print-machine-update-kitchen-data').removeClass('d-none')

        } else {
            $('#inputs-type-print-machine-update-kitchen-data').addClass('d-none')
        }
    })

    $('#check-update-setting-printer').on('click', function () {
        if ($(this).is(':checked')) {
            $('#check-update-setting-printer').prop('checked', true);
            $('#update-setting-printer').removeClass('d-none');
            $('#inputs-type-print-machine-update-kitchen-data').addClass('d-none');
            $('.select-type-print-update-kitchen-data').val(-1).trigger('change.select2');
            $('#inputs-type-print-machine-update-kitchen-data input').val('');
            // máy stamp
            if (printTypeUpdateKitchenData === 4) {
                $('#form-paper-status-kitchen-data input').eq(1).prop('checked', true);
            } else {
                $('#form-paper-status-kitchen-data input').eq(0).prop('checked', true);
            }
        } else {
            $('#check-update-setting-printer').prop('checked', false);
            $('#update-setting-printer').addClass('d-none');
            $('#inputs-type-print-machine-update-kitchen-data').addClass('d-none');
        }
    })
    $('#printer-port-update-kitchen-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#printer-paper-size-update-kitchen-data').select();
        }
    });
    await dataUpdateKitchenData();
}

async function dataUpdateKitchenData() {
    let method = 'get',
        url = 'kitchen-data.data-update',
        params = {id: idUpdateKitchen},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-kitchen-data')]);
    nameKitchenUpdateKitchenData =1;
    printTypeUpdateKitchenData = res.data.data.type;
    nameKitchenUpdateKitchenData = res.data.data.name;
    descriptionKitchenUpdateKitchenData = res.data.data.description;
    isHavePrinterKitchenUpdateKitchenData = res.data.data.is_have_printer;
    isPrintEachFoodKitchenUpdateKitchenData = res.data.data.is_print_each_food;
    printerIPAddressKitchenUpdateKitchenData = res.data.data.printer_ip_address;
    printerNameKitchenUpdateKitchenData = res.data.data.printer_name;
    printerPaperSizeKitchenUpdateKitchenData = res.data.data.printer_paper_size;
    printerPortKitchenUpdateKitchenData = res.data.data.printer_port;
    //ENUM PRINT_TYPE : loại bếp
    // DRINK_AND_GOODS(0), FOOD(1), CASHIER(2), FISHBOWL(3), STAMP(4);


    //ENUM PRINT_TYPE : loại máy in
    // 0: LAN/WIFI 1: IMIN 2: SUMIN

    //bắt các case ẩn hiển theo máy in
    if (res.data.data.printer_name == '') {
        //thiếp lập máy in nhưng không phải máy lan/wifi
        if (res.data.data.printer_type !== 0 && res.data.data.printer_paper_size !== 0) {
            $('#check-update-setting-printer').prop('checked', true);
            $('#inputs-type-print-machine-update-kitchen-data').addClass('d-none')
            $('#update-setting-printer').removeClass('d-none');
        }
        //không thiết lập máy in nhưng print_type !== 0
        else if (res.data.data.printer_type !== 0 && res.data.data.printer_paper_size === 0) {
            $('#check-update-setting-printer').prop('checked', false);
            $('#update-setting-printer').addClass('d-none');
            $('#inputs-type-print-machine-update-kitchen-data').addClass('d-none')
        } else {
            $('#check-update-setting-printer').prop('checked', false);
            $('#update-setting-printer').addClass('d-none');
            $('#inputs-type-print-machine-update-kitchen-data').addClass('d-none')
        }
    } else if (res.data.data.printer_name !== '') {
        //thiết lập máy in nhưng là máy lan/wifi
        if (res.data.data.printer_type === 0) {
            $('#check-update-setting-printer').prop('checked', true);
            $('#update-setting-printer').removeClass('d-none');
            $('#inputs-type-print-machine-update-kitchen-data').removeClass('d-none')
        }
        //thiết lập máy in không phả là máy lan/wifi và có print_name
        else {
            $('#check-update-setting-printer').prop('checked', true);
            $('#update-setting-printer').removeClass('d-none');
            $('#inputs-type-print-machine-update-kitchen-data').addClass('d-none')
        }
    } else {
        $('#check-update-setting-printer').prop('checked', false);
        $('#update-setting-printer').removeClass('d-none');
    }
    // ẩn hiện loại giấy ( stamp 30, 50, còn lại 80)
    if (res.data.data.type === 4) {
        $('#form-paper-stamp-kitchen-data').removeClass('d-none');
        $('#form-paper-status-kitchen-data').addClass('d-none');
    } else {
        $('#form-paper-stamp-kitchen-data').addClass('d-none');
        $('#form-paper-status-kitchen-data').removeClass('d-none');
    }

    // ẩn hiện bộ lọc loại máy in ( thu ngân và còn lại : 3 máy , máy stamp, hồ hải sản: 1 máy (lan/wifi)
    if (res.data.data.type === 3 || res.data.data.type === 4) {
        $('#select-print-machine-not-cashier').removeClass('d-none');
        $('#select-print-machine-cashier').addClass('d-none');
    } else {
        $('#select-print-machine-cashier').removeClass('d-none');
        $('#select-print-machine-not-cashier').addClass('d-none');
    }
    $('#name-update-kitchen-data').val(res.data.data.name);
    $('#description-update-kitchen-data').val(res.data.data.description);
    $('#id-update-kitchen-data').text(res.data.data.id);
    $('#status-update-kitchen-data').text(res.data.data.status);
    $('#type-kitchen-update-kitchen-data input[value=' + res.data.data.type + ']').prop('checked', true);
    $('#branch-id-update-kitchen-data').text(res.data.data.branch_id);
    $('#printer-name-update-kitchen-data').val(res.data.data.printer_type !== 0 ? '' : res.data.data.printer_name);
    $('#printer-ip-update-kitchen-data').val(res.data.data.printer_type !== 0 ? '' : res.data.data.printer_ip_address);
    $('.select-type-print-update-kitchen-data').val(res.data.data.printer_type).trigger('change.select2');
    $('#printer-port-update-kitchen-data').val('9100');
    $('#select-paper-status-update-kitchen-data input[value=' + res.data.data.printer_paper_size + ']').prop('checked', true);
    $('#select-printer-status-update-kitchen-data input[value=' + res.data.data.is_have_printer + ']').prop('checked', true);
    $('#status-update-is-each-print-kitchen-data').prop('checked', Boolean(res.data.data.is_print_each_food));
    countCharacterTextarea()
}

async function saveModalUpdateKitchenData() {
    let flag = 0;
    if (Number($('#check-update-setting-printer').is(':checked'))) {
        if (!checkValidateSave($('#update-kitchen-modal'))) flag = 1;
        if (!checkValidateSave($('#update-setting-printer'))) flag = 1;
    } else {
        if (!checkValidateSave($('#update-kitchen-modal'))) flag = 1;
    }
    if (flag) return false;
    if (checkSaveUpdateKitchenData === 1) return false;
    checkSaveUpdateKitchenData = 1;
    let id = $('#id-update-kitchen-data').text(),
        name = $('#name-update-kitchen-data').val(),
        description = $('#description-update-kitchen-data').val(),
        status = $('#status-update-kitchen-data').text(),
        printer_name = $('#printer-name-update-kitchen-data').val(),
        printer_ip_address = $('#printer-ip-update-kitchen-data').val(),
        printer_port = removeformatNumber($('#type-update-kitchen-data .col-lg-12 h6').text()),
        printer_paper_size = $('#select-paper-status-update-kitchen-data').find('input[type="radio"]:checked').val(),
        is_have_printer = $('#select-printer-status-update-kitchen-data').find('input[type="radio"]:checked').val(),
        is_print_each_food = Number($('#status-update-is-each-print-kitchen-data').is(':checked')),
        branch_id = $('.select-branch').val();
    if (!Number($('#check-update-setting-printer').is(':checked'))) {
        printer_name = '';
        printer_ip_address = '';
        printer_port = '';
        printer_paper_size = '';
        is_have_printer = '';
        is_print_each_food = '';
    }
    let print_type;
    if (!$('#select-print-machine-not-cashier').hasClass('d-none')) {
        print_type = $('#select-print-machine-not-cashier select').val();
    } else {
        print_type = $('#select-print-machine-cashier select').val()
    }

    if(nameKitchenUpdateKitchenData == name
        && descriptionKitchenUpdateKitchenData == description
        && isHavePrinterKitchenUpdateKitchenData == is_have_printer
        && isPrintEachFoodKitchenUpdateKitchenData == is_print_each_food
        && printerIPAddressKitchenUpdateKitchenData == printer_ip_address
        && printerNameKitchenUpdateKitchenData == printer_name
        && printerPaperSizeKitchenUpdateKitchenData == printer_paper_size
        && printerPortKitchenUpdateKitchenData == printer_port) {
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalUpdateKitchenData();
        checkSaveUpdateKitchenData = 0;
        return false;
    }

    let method = 'post',
        url = 'kitchen-data.update',
        params = null,
        data = {
            id: id,
            branch_id: branch_id,
            name: name,
            description: description,
            status: status,
            printer_name: printer_name,
            printer_ip_address: printer_ip_address,
            printer_port: printer_port,
            printer_paper_size: printer_paper_size,
            is_have_printer: is_have_printer,
            is_print_each_food: is_print_each_food,
            print_type: print_type,
            type: dataTypeKitchenUpdate,
        };

    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-kitchen-data')]);
    checkSaveUpdateKitchenData = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            thisUpdateKitchenData.parents('tr').find('td:eq(1)').html(res.data.data.name);
            thisUpdateKitchenData.parents('tr').find('td:eq(2)').text(res.data.data.type_text);
            thisUpdateKitchenData.parents('tr').find('td:eq(3)').html(res.data.data.description);
            thisUpdateKitchenData.parents('tr').find('td:eq(4)').html(res.data.data.action);
            if(res.data.data.status === 0) {
                $('#table-disable-kitchen-data').find('[data-toggle="tooltip"]').tooltip();
            } else {
                $('#table-enable-kitchen-data').find('[data-toggle="tooltip"]').tooltip();
            }
            closeModalUpdateKitchenData();
            break;
        case 500:
            ErrorNotify(res.data.message);
            break;
        default:
            WarningNotify(res.data.message)
    }

}

function closeModalUpdateKitchenData() {
    $('#modal-update-kitchen-data').modal('hide');
    shortcut.remove("F4");
    shortcut.remove('ESC')
    shortcut.add('F2', function () {
        openModalCreateKitchenData();
    })
    resetModalUpdateKitchenData();
    countCharacterTextarea()
}

function resetModalUpdateKitchenData() {
    $('#id-update-kitchen-data').text('');
    $('#name-update-kitchen-data').val('');
    $('#description-update-kitchen-data').val('');
    $('#branch-id-update-kitchen-data').text('');
    $('#status-update-kitchen-data').text('');
    $('input[name="status"]').prop('checked', false);
    $('input[name="size"]').prop('checked', true);
    $('#check-update-setting-printer').prop('checked', false);
    $('#type-kitchen-update-kitchen-data input:first').prop('checked', true);
}


