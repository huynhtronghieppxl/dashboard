let checkSaveCreateUnitOrderData = 0;

$(function () {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateUnitOrderData();
    });
})


function openModalCreateUnitOrderData() {
    $('#modal-create-unit-order-data').modal('show');
    shortcut.add('F4', function () {
        saveCreateUnitOrderData();
    });
    shortcut.add('ESC', function () {
        closeModalCreateUnitOrderData();
    });
    shortcut.remove('F2');

    checkSaveCreateUnitOrderData = 0;
}

async function saveCreateUnitOrderData() {
    if (checkSaveCreateUnitOrderData === 1) return false;
    if (!checkValidateSave($('.create-unit-order-data'))) return false;
    checkSaveCreateUnitOrderData = 1;
    let url = 'unit-order-data.create',
        method = 'post',
        params = null,
        data = {
            name: $('#name-create-unit-order-data').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$('#create-unit-order-data')]);
    checkSaveCreateUnitOrderData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalCreateUnitOrderData();
            drawDataTableUnitOrder(res.data.data);
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function drawDataTableUnitOrder(data) {
    addRowDatatableTemplate(dataTableUnitOrder, {
        'name': data.name,
        'total_material_unit_map': 0,
        'action': data.action,
        'keysearch': data.keysearch
    });
}

function closeModalCreateUnitOrderData() {
    $('#modal-create-unit-order-data').modal('hide');
    $('#name-create-unit-order-data').val('');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateUnitOrderData();
    });
}

