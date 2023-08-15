let checkSaveUpdateUnitFoodData = 0,thisUpdateUnitData;

function openModalUpdateUnitFoodData(r) {
    thisUpdateUnitData = r;
    $('#modal-update-unit-food-data').modal('show');
    addLoading('unit-food-data.update', '#loading-modal-update-unit-food-data');
    shortcut.add('F4', function () {
        saveModalUpdateUnitFoodData();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateUnitFoodData();
    });
    $('#name-update-unit-food-data').val(thisUpdateUnitData.attr('data-name'));
    // $('#modal-update-unit-food-data input').on('keyup', function () {
    //     $('#modal-update-unit-food-data .btn-renew').removeClass('d-none')
    // })
}
function resetModalUpdateUnitFoodData() {
    removeAllValidate();
    $('#modal-update-unit-food-data input').val('');
    $('#modal-update-unit-food-data .btn-renew').addClass('d-none')
}
async function saveModalUpdateUnitFoodData() {
    if (checkSaveUpdateUnitFoodData !== 0) return false;
    if(!checkValidateSave($('#modal-update-unit-food-data'))) return false
    let name = $('#name-update-unit-food-data').val();
    checkSaveUpdateUnitFoodData = 1;
    let url = 'unit-food-data.update',
        method = 'post',
        params = null,
        data = {
            id: thisUpdateUnitData.data('id'),
            name: name,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-unit-food-data')]);
    checkSaveUpdateUnitFoodData = 0;
    switch (res.data.status){
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            closeModalUpdateUnitFoodData();
            drawDataUpdateUnitData(res.data.data);
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }
}

function closeModalUpdateUnitFoodData() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    removeAllValidate();
    $('#modal-update-unit-food-data').modal('hide');
    $('#name-update-unit-food-data').val('');
}

function drawDataUpdateUnitData(data) {
    thisUpdateUnitData.parents('tr').find('td:eq(1)').text(data.name);
    thisUpdateUnitData.attr('data-name', data.name);
}
