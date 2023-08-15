let thisUpdateSurchargeData, idUpdateSurchargeData, statusUpdateSurchargeData, brandUpdateSurchargeData, checkUpdateSurchargeData;

function openModalUpdateSurchargeData(r) {
    checkUpdateSurchargeData = 0;
    idUpdateSurchargeData = r.data('id');
    statusUpdateSurchargeData = r.data('status');
    brandUpdateSurchargeData = r.data('brand');
    thisUpdateSurchargeData = r;
    $('#modal-update-surcharge-data').modal('show');
    shortcut.add('ESC', function () {
        closeModalUpdateSurchargeData();
    });
    shortcut.add('F4', function () {
        saveUpdateSurchargeData();
    });

    $('#select-option-update-vat-surcharge-data').select2({
        dropdownParent: $('#modal-update-surcharge-data'),
    })
    $('#select-option-update-vat-surcharge-data').html(dataListVatSurchargeData);
    if(Number(r.data('restaurant-vat-config-id')) !== 0){
        $('#select-option-update-vat-surcharge-data').val(r.data('restaurant-vat-config-id')).trigger('change.select2');
    }
    $('#name-update-surcharge-data').val(r.data('name'));
    $('#price-update-surcharge-data').val(r.data('price'));
    $('#description-update-surcharge-data').val(r.data('description'));
    countCharacterTextarea()
}

async function saveUpdateSurchargeData() {
    if (checkUpdateSurchargeData === 1) return false;
    if (!checkValidateSave($('#modal-update-surcharge-data')))return false;
    checkUpdateSurchargeData = 1;
    let method = 'post',
        url = 'surcharge-data.update',
        params = null,
        data = {
            id: idUpdateSurchargeData,
            status: statusUpdateSurchargeData,
            brand: brandUpdateSurchargeData,
            name: $('#name-update-surcharge-data').val(),
            price: removeformatNumber($('#price-update-surcharge-data').val()),
            description: $('#description-update-surcharge-data').val(),
            vat: $('#select-option-update-vat-surcharge-data').val() == '' ? 0 : $('#select-option-update-vat-surcharge-data').val()
        };
    let text = $('#success-update-data-to-server').text();

    if (data.name == thisUpdateSurchargeData.data('name')
        && data.price == removeformatNumber(thisUpdateSurchargeData.data('price'))
        && data.description == thisUpdateSurchargeData.data('description')
        && data.vat == thisUpdateSurchargeData.data('restaurant-vat-config-id')) {
        SuccessNotify(text);
        closeModalUpdateSurchargeData();
        checkUpdateSurchargeData = 0;
        return
    }
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-surcharge-data')]);
    checkUpdateSurchargeData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify(text);
            closeModalUpdateSurchargeData();
            thisUpdateSurchargeData.parents('tr').find('td:eq(1)').text(res.data.data.name);
            thisUpdateSurchargeData.parents('tr').find('td:eq(2)').text(res.data.data.price);
            thisUpdateSurchargeData.parents('tr').find('td:eq(3)').text(res.data.data.vat);
            thisUpdateSurchargeData.parents('tr').find('td:eq(4)').text(res.data.data.created_at);
            thisUpdateSurchargeData.parents('tr').find('td:eq(5)').html(res.data.data.action);
            thisUpdateSurchargeData.parents('tr').find('td:eq(6)').text(res.data.data.keysearch);
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function closeModalUpdateSurchargeData() {
    $('#modal-update-surcharge-data').modal('hide');
    resetModalUpdateSurchargeData();
}
function resetModalUpdateSurchargeData() {
    $('#name-update-surcharge-data').val('');
    $('#price-update-surcharge-data').val(formatNumber(1000));
    $('#description-update-surcharge-data').val('');
    $('#select-option-vat-surcharge-data').val('').trigger('change.select2');
}


