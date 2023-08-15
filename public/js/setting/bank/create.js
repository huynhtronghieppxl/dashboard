let checkSaveCreateBankData = 0,
    checkSearchBankNumberBankSetting = 0;

$(function () {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateBankData();
    });
})

async function openModalCreateBankData() {
    $('#modal-create-bank-data').modal('show');
    $('#bank-create-bank-data').select2({
        dropdownParent: $('#modal-create-bank-data'),
    })

    shortcut.add('ESC', function () {
        closeModalCreateBankData();
    });
    shortcut.add('F4', function () {
        saveModalCreateBankData();
    });
    shortcut.remove('F2');

    $('#btn-bank-number-create-bank-search').on('click', function () {
        $('#account-name-create-bank-table-setting').prop("disabled", false);
        searchBankNumberBankSetting();
    })


    $('#modal-create-bank-data').on('click focus', function () {
        $('#data-search-bank-number-bank-manage').addClass('d-none');
    })
    $(document).on('click', '.item-search-customer', function () {
        $('#data-search-bank-number-bank-manage').addClass('d-none');
        $('#bank-number-create-bank-manage').val($(this).data('bank-number'));
        $('#account-name-create-bank-table-setting').val($(this).data('account-name'));
        $('#account-name-create-bank-table-setting').prop("disabled", true);
    })


    $('#bank-number-create-bank-manage').on('click', function () {
        if ($(this).val() !== "") {
            $('#data-search-bank-number-bank-manage').removeClass('d-none');
        }
    })

    await dataBankOptionBankData();
    $('#bank-create-bank-data').val("").trigger('change.select2');
}

async function saveModalCreateBankData() {
    if (checkSaveCreateBankData === 1) {
        return false;
    }
    if (!checkValidateSave($('#modal-create-bank-data'))) return false;
    let brand = $('.select-brand-bank-data').val(),
        bank_identify_id = $('#bank-create-bank-data').val(),
        bank_name = $('#bank-create-bank-data').find(':selected').text(),
        bank_number = $('#bank-number-create-bank-manage').val(),
        bank_account_name = $('#account-name-create-bank-table-setting').val(),
        is_default = 0;

    // if (bank_account_name.trim() === '') {
    //     WarningNotify("Số tài khoản không hợp lệ!");
    //     return;
    // }

    if ($('#is-default-create-bank-data').is(':checked')) {
        is_default = 1;
    }


    let url = 'bank-setting.create' ,
        method = 'post',
        params = null,
        data = {
            restaurant_brand_id: brand,
            bank_name: bank_name,
            bank_identify_id: bank_identify_id,
            bank_number: bank_number,
            bank_account_name: bank_account_name,
            is_default: is_default,
        },
        text = $('#success-status-data-to-server').text();
    checkSaveCreateBankData = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-bank-data')]);
    checkSaveCreateBankData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify(text);
            if (res.data.data.is_default === 1) {
                let checked = $('#table-enable-bank-data').find('.pointer-none:checkbox:checked');
                checked.prop('checked', false);
                checked.removeClass('pointer-none')
                $('#name-bank-account').text(`${res.data.data.bank_name} - ${res.data.data.bank_account_name}`)
                $('#name-branch').text($('.select-brand-bank-data').find(':selected').text());
            }
            addRowDatatableTemplate(dataTableBankEnable, {
                'checkbox': res.data.data.checkbox,
                'bank_name': res.data.data.bank_name,
                'bank_number': res.data.data.bank_number,
                'bank_account_name': res.data.data.bank_account_name,
                'action': res.data.data.action,
                'keysearch': res.data.data.keysearch,
            })
            $('#total-record-enable').text(parseInt($('#total-record-enable').text()) + 1);
            closeModalCreateBankData();
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

async function searchBankNumberBankSetting() {
    if (checkSearchBankNumberBankSetting === 1) {
        return;
    }
    $('#account-name-create-bank-table-setting').removeAttr('data-empty');
    $('#account-name-create-bank-table-setting').removeAttr('data-spec');
    $('#account-name-create-bank-table-setting').removeAttr('data-min-length');

    if (!checkValidateSave($('#modal-create-bank-data'))) {
        $('#account-name-create-bank-table-setting').attr('data-empty', 1);
        $('#account-name-create-bank-table-setting').attr('data-spec', 1);
        $('#account-name-create-bank-table-setting').attr('data-min-length', 1);
        return false
    };

    $('#bank-number-create-bank-manage').data('id', 0);
    $('#account-name-create-bank-table-setting').val('');
    let method = 'post',
        url = 'bank-setting.search-bank-number',
        bin = $('#bank-create-bank-data').val(),
        number = $('#bank-number-create-bank-manage').val(),
        params = {bin: bin, number: number},
        data = null;
    checkSearchBankNumberBankSetting = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#bank-number-create-bank-manage')]);
    checkSearchBankNumberBankSetting = 0;
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



function closeModalCreateBankData() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateBankData();
    });
    $('#modal-create-bank-data').modal('hide');
    reloadModalCreateBankTable()
}

function reloadModalCreateBankTable() {
    removeAllValidate();
    $('#bank-create-bank-data').val(-1).trigger('change.select2')
    $('#bank-number-create-bank-manage').val('')
    $('#data-search-bank-number-bank-manage').addClass('d-none');
    $('#data-search-bank-number-bank-manage').html('');
    $('#account-name-create-bank-table-setting').val('');
}
