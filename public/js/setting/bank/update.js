let checkDataBankUpdateBankData = 0, optionBankUpdateBank, thisUpdateCurrentData, checkSaveUpdateBank = 0;

async function openModalUpdateBank(r) {
    thisUpdateCurrentData = r;
    $('#modal-update-bank-data').modal('show');
    $('#bank-update-bank-data').select2({
        dropdownParent: $('#modal-update-bank-data'),
    })

    shortcut.add('ESC', function () {
        closeModalUpdateBank();
    });
    shortcut.add('F4', function () {
        saveModalUpdateBankData();
    });
    shortcut.remove('F2');

    $('#btn-bank-number-update-bank-search').on('click', function () {
        $('#account-name-update-bank-table-setting').prop("disabled", false);
            searchBankNumberUpdateBankSetting();
    })

    $('#modal-update-bank-data').on('click focus', function () {
        $('#data-search-bank-number-bank-manage').addClass('d-none');
    })
    $(document).on('click', '.item-search-customer', function () {
        $('#data-search-bank-number-bank-manage').addClass('d-none');
        $('#bank-number-update-bank-manage').val($(this).data('bank-number'));
        $('#account-name-update-bank-table-setting').val($(this).data('account-name'));
        $('#account-name-update-bank-table-setting').prop("disabled", true);
    })


    $('#bank-number-update-bank-manage').on('click', function () {
        if ($(this).val() !== "") {
            $('#data-search-bank-number-bank-manage').removeClass('d-none');
        }
    })

    $('#bank-number-update-bank-manage').val(r.parents('tr').find('td:eq(3)').text());
    $('#account-name-update-bank-table-setting').val(r.parents('tr').find('td:eq(4)').text());
    if (r.parents('tr').find('td:eq(1)').find('input').is(':checked')) {
        $('#is-default-update-bank-data').prop("checked",true);
    } else {
        $('#is-default-update-bank-data').prop("checked",false)
    }

    dataInfoUpdateBankData()
    await dataBankOptionBankData()
    $('#bank-update-bank-data').val(thisUpdateCurrentData.data('identify')).trigger('change.select2');
}

function dataInfoUpdateBankData() {
    switch (thisUpdateCurrentData.parents('table').data('tab')) {
        case 0:
            $('#bank-number-update-bank-manage').val(thisUpdateCurrentData.parents('tr').find('td:eq(3)').text());
            $('#account-name-update-bank-table-setting').val(thisUpdateCurrentData.parents('tr').find('td:eq(4)').text());
            if (thisUpdateCurrentData.parents('tr').find('td:eq(1)').find('input').is(':checked')) {
                $('#is-default-update-bank-data').prop("checked",true);
            } else {
                $('#is-default-update-bank-data').prop("checked",false)
            }
            $('.is-default-update-bank-data').removeClass('d-none')
            break;
        case 1:
            $('#bank-number-update-bank-manage').val(thisUpdateCurrentData.parents('tr').find('td:eq(2)').text());
            $('#account-name-update-bank-table-setting').val(thisUpdateCurrentData.parents('tr').find('td:eq(3)').text());
            $('.is-default-update-bank-data').addClass('d-none')
            break;
    }
}

async function saveModalUpdateBankData() {
    if (checkSaveUpdateBank === 1) {
        return 0;
    }
    if (!checkValidateSave($('#modal-update-bank-data'))) return false;
    let brand = $('.select-brand-bank-data').val(),
        bank_identify_id = $('#bank-update-bank-data').val(),
        bank_name = $('#bank-update-bank-data').find(':selected').text(),
        bank_number = $('#bank-number-update-bank-manage').val(),
        bank_account_name = $('#account-name-update-bank-table-setting').val(),
        is_default = 0;

    // if (bank_account_name.trim() === '') {
    //     WarningNotify("Số tài khoản không hợp lệ!");
    //     return;
    // }

    if ($('#is-default-update-bank-data').is(':checked')) {
        is_default = 1;
    }

    let url = 'bank-setting.update' ,
        method = 'post',
        params = null,
        data = {
            id: thisUpdateCurrentData.data('id'),
            restaurant_brand_id: brand,
            bank_name: bank_name,
            bank_identify_id: bank_identify_id,
            bank_number: bank_number,
            bank_account_name: bank_account_name,
            is_default: is_default,
        },
        text = $('#success-update-data-to-server').text();


    if (checkChangeUpdateBank(data)) {
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalUpdateBank();
        return;
    }


    checkSaveUpdateBank = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-bank-data')]);
    checkSaveUpdateBank = 0
    switch(res.data.status) {
        case 200:
            SuccessNotify(text);
            drawDatatableUpdateBank()
            closeModalUpdateBank();
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

function checkChangeUpdateBank(data) {
    if (thisUpdateCurrentData.parents('table').data('tab') === 0) {
        if (data.bank_name == thisUpdateCurrentData.parents('tr').find('td:eq(2)').text()
            && data.bank_number == thisUpdateCurrentData.parents('tr').find('td:eq(3)').text()
            && data.bank_account_name == thisUpdateCurrentData.parents('tr').find('td:eq(4)').text()
            && !!data.is_default === thisUpdateCurrentData.parents('tr').find(':checkbox').is(':checked')) {
            return true;
        }
    } else {
        if (data.bank_name == thisUpdateCurrentData.parents('tr').find('td:eq(1)').text()
            && data.bank_number == thisUpdateCurrentData.parents('tr').find('td:eq(2)').text()
            && data.bank_account_name == thisUpdateCurrentData.parents('tr').find('td:eq(4)').text()) {
            return true;
        }
    }
    return false;
}

function drawDatatableUpdateBank() {
    if (thisUpdateCurrentData.parents('table').data('tab') === 0) {
        thisUpdateCurrentData.parents('tr').find('td:eq(2)').text($('#bank-update-bank-data').find(':selected').text())
        thisUpdateCurrentData.parents('tr').find('td:eq(3)').text($('#bank-number-update-bank-manage').val())
        thisUpdateCurrentData.parents('tr').find('td:eq(4)').text($('#account-name-update-bank-table-setting').val());
        if ($('#is-default-update-bank-data').prop('checked')) {
            let checked = thisUpdateCurrentData.parents('table').find('.pointer-none:checkbox:checked');
            checked.prop('checked', false);
            checked.removeClass('pointer-none')
            thisUpdateCurrentData.parents('tr').find(':checkbox').prop('checked', true)
            thisUpdateCurrentData.parents('tr').find(':checkbox').addClass('pointer-none');
        }
    } else {
        thisUpdateCurrentData.parents('tr').find('td:eq(1)').text($('#bank-update-bank-data').find(':selected').text())
        thisUpdateCurrentData.parents('tr').find('td:eq(2)').text($('#bank-number-update-bank-manage').val())
        thisUpdateCurrentData.parents('tr').find('td:eq(3)').text($('#account-name-update-bank-table-setting').val());
    }
}

async function searchBankNumberUpdateBankSetting() {
    $('#account-name-update-bank-table-setting').removeAttr('data-empty');
    $('#account-name-update-bank-table-setting').removeAttr('data-spec');
    $('#account-name-update-bank-table-setting').removeAttr('data-min-length');
    if (!checkValidateSave($('#modal-update-bank-data'))) {
        $('#account-name-update-bank-table-setting').attr('data-empty', 1);
        $('#account-name-update-bank-table-setting').attr('data-spec', 1);
        $('#account-name-update-bank-table-setting').attr('data-min-length', 1);
        return false
    }


    $('#bank-number-update-bank-manage').data('id', 0);
    $('#account-name-update-bank-table-setting').val('');
    let method = 'post',
        url = 'bank-setting.search-bank-number',
        bin = $('#bank-update-bank-data').val(),
        number = $('#bank-number-update-bank-manage').val(),
        params = {bin: bin, number: number},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#bank-number-update-bank-manage')]);
    if (res.data.status === 200) {
        $('#data-search-bank-number-bank-manage').removeClass('d-none');
        $('#data-search-bank-number-bank-manage').html(res.data.data.account_name);
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalUpdateBank() {
    $('#modal-update-bank-data').modal('hide');
    reloadModalUpdateBankTable()
}

function reloadModalUpdateBankTable() {
    removeAllValidate();
    $('#bank-update-bank-data').val(-1).trigger('change.select2')
    $('#bank-number-update-bank-manage').val('')
    $('#data-search-bank-number-bank-manage').addClass('d-none');
    $('#data-search-bank-number-bank-manage').html('');
    $('#account-name-update-bank-table-setting').val('');
}
