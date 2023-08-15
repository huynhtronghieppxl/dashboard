let thisUpdateUnitOrderData, checkSaveUpdateUnitOrderData = 0, idUpdateUnitOrderData;

function openModalUpdateUnitOrderData(r) {
    thisUpdateUnitOrderData = r;
    $('#modal-update-unit-order-data').modal('show');
    addLoading('unit-order-data.update', '#loading-modal-update-unit-order-data');
    shortcut.add('F4', function () {
        saveUpdateUnitOrderData();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateUnitOrderData();
    });
    checkSaveUpdateUnitOrderData = 0;
    idUpdateUnitOrderData = r.data('id');
    $('#name-update-unit-order-data').val(r.parents('tr').find('td:eq(1)').text());
}

async function saveUpdateUnitOrderData() {
    if (checkSaveUpdateUnitOrderData === 1) return false;
    if (!checkValidateSave($('.update-unit-order-data'))) return false;
    checkSaveUpdateUnitOrderData = 1;
    let url = 'unit-order-data.update',
        method = 'post',
        params = null,
        data = {
            id: idUpdateUnitOrderData,
            name: $('#name-update-unit-order-data').val(),
        };
    let text = $('#success-update-data-to-server').text();
    if (thisUpdateUnitOrderData.data('name') === data.name) {
        SuccessNotify(text);
        closeModalUpdateUnitOrderData();
        checkSaveUpdateUnitOrderData = 0;
        return
    }

    let res = await axiosTemplate(method, url, params, data, [$('#update-unit-order-data')]);
    checkSaveUpdateUnitOrderData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify(text);
            thisUpdateUnitOrderData.parents('tr').find('td:eq(1)').text($('#name-update-unit-order-data').val());
            closeModalUpdateUnitOrderData();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalUpdateUnitOrderData() {
    $('#modal-update-unit-order-data').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#name-update-unit-order-data').val('');
}
