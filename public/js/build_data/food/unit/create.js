let checkSaveCreateUnitData = 0;

function openModalCreateUnitFoodData() {
    $('#modal-create-unit-food-data').modal('show');
    $('#modal-create-unit-food-data').on('shown.bs.modal', function () {
        $('#name-create-unit-food-data').focus();
    });
    addLoading('unit-food-data.create', '#loading-modal-create-unit-food-data');
    shortcut.add('F4', function () {
        saveModalCreateUnitFoodData();
    });
    shortcut.add('ESC', function () {
        closeModalCreateUnitFoodData();
    });
    checkSaveCreateUnitData = 0;
    $('#modal-create-unit-food-data input').on('keyup', function () {
        $('#modal-create-unit-food-data .btn-renew').removeClass('d-none')
    })
}

async function saveModalCreateUnitFoodData() {
    if (checkSaveCreateUnitData !== 0) return false;
    if (!checkValidateSave($('#modal-create-unit-food-data'))) return false;
    let name = $('#name-create-unit-food-data').val();
    checkSaveCreateUnitData = 1;
    let url = 'unit-food-data.create',
        method = 'post',
        params = null,
        data = {
            name: name,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-unit-food-data')]);
    checkSaveCreateUnitData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            drawCreateUnitData(res.data.data);
            closeModalCreateUnitFoodData();
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }
}

function closeModalCreateUnitFoodData() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-create-unit-food-data').modal('hide');
    resetModalCreateUnitFoodData();
}

function resetModalCreateUnitFoodData() {
    removeAllValidate();
    $('#modal-create-unit-food-data input').val('');
    $('#modal-create-unit-food-data .btn-renew').addClass('d-none')
}

function drawCreateUnitData(data) {
    addRowDatatableTemplate(tableUnitFoodData, {
        'name': data.name,
        'action': '<div class="btn-group btn-group-sm">' +
            '<button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeUnitFoodData($(this))" data-id="' + data.id + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-name="' + data.name + '" data-id="' + data.id + '" onclick="openModalUpdateUnitFoodData($(this))" title=""><i class="fi-rr-pencil"></i></button>' +
            '</div>',
        'keysearch': data.keysearch
    });
}
