let checkSaveCreateSurchargeData;

$(function () {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateSurchargeData();
    });
})

async function openModalCreateSurchargeData() {
    checkSaveCreateSurchargeData = 0;
    $('#modal-create-surcharge-data').modal('show');
    shortcut.add('ESC', function () {
        closeModalCreateSurchargeData();
    });
    shortcut.add('F4', function () {
        saveCreateSurchargeData();
    });
    shortcut.remove('F2');
    $('#price-create-surcharge-data').val(formatNumber(1000));
    $('#select-option-vat-surcharge-data').select2({
        dropdownParent: $('#modal-create-surcharge-data'),
    })
    $('#name-create-surcharge-data, #price-create-surcharge-data, #description-create-surcharge-data').on('input', function () {
        $('.btn-renew').removeClass('d-none');
    })
    getVat();
}

async function saveCreateSurchargeData() {
    if (checkSaveCreateSurchargeData === 1) return false;
    if (!checkValidateSave($('#modal-create-surcharge-data'))) return false;
    checkSaveCreateSurchargeData = 1;
    let method = 'post',
        url = 'surcharge-data.create',
        params = null,
        data = {
            brand: $('.select-brand-surcharge-data').val(),
            name: $('#name-create-surcharge-data').val(),
            price: removeformatNumber($('#price-create-surcharge-data').val()),
            description: $('#description-create-surcharge-data').val(),
            vat: $('#select-option-vat-surcharge-data').val() == '' ? 0 : $('#select-option-vat-surcharge-data').val()
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-surcharge-data')]);
    checkSaveCreateSurchargeData = 0;
    let text = ''
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalCreateSurchargeData();
            $('#total-record-enable').text(removeformatNumber($('#total-record-enable').text()) + 1);
            addRowDatatableTemplate(tableEnableSurchargeData, {
                'name': res.data.data.name,
                'description': res.data.data.description,
                'price': res.data.data.price,
                'created_at': res.data.data.created_at,
                'vat': res.data.data.vat,
                'action': res.data.data.action,
                'keysearch': res.data.data.keysearch,
            });
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
            WarningNotify(text)
    }
}

function closeModalCreateSurchargeData() {
    $('#modal-create-surcharge-data').modal('hide');
    resetModalCreateSurchargeData();
    $('#select-option-vat-surcharge-data').val('').trigger('change.select2')
    countCharacterTextarea()
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateSurchargeData();
    });
}

function resetModalCreateSurchargeData() {
    $('#name-create-surcharge-data').val('');
    $('#price-create-surcharge-data').val(formatNumber(1000));
    $('#description-create-surcharge-data').val('');
    $('.btn-renew').addClass('d-none');
}
