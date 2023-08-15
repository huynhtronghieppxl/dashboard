let idUpdateCostData, checkSaveUpdateCostData = 0, thisUpdateCostData;
async function openModalUpdateCostData(r) {
    thisUpdateCostData = r;
    checkSaveUpdateCostData = 0;
    idUpdateCostData = r.data('id');
    $('#modal-update-cost-data').modal('show');
    await $('#select-update-cost-data').html(typeCostData);
    $('#select-update-cost-data').val(r.data('type')).trigger('change.select2');
    if ($('#select-update-cost-data').val() == null){
        $('#select-update-cost-data').val(null).trigger('change.select2');
    }
    $('#cost-data-name-update').val(r.data('name'));
    $('#select-update-cost-data').select2({
        dropdownParent: $('#modal-update-cost-data'),
    });
    shortcut.add('F4', function () {
        saveUpdateCostData();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalUpdateCostData();
    })
}

async function saveUpdateCostData() {
    if (checkSaveUpdateCostData === 1) return false;
    if(!checkValidateSave($('#modal-cost-data-detail-content'))) return false;
    let name = $('#cost-data-name-update').val(),
        type = $('#select-update-cost-data').find('option:selected').val();
    checkSaveCreateCostData = 1;
    let method = 'post',
        url = 'cost-data.update',
        params = null,
        data = {
            id: idUpdateCostData,
            name: name,
            type: type
        };
    let text = 'Chỉnh sửa thành công !'
    if (thisUpdateCostData.data('name') === data.name) {
        SuccessNotify(text);
        closeModalUpdateCostData();
        checkSaveUpdateCostData = 0;
        return
    }
    let res = await axiosTemplate(method, url, params, data, [$('#modal-cost-data-detail-content')]);
    checkSaveUpdateCostData = 0;
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalUpdateCostData();
            drawUpdateCostData(res.data.data);
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
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

function drawUpdateCostData(data) {
    thisUpdateCostData.parents('tr').find('td:eq(1)').text(data.name);
    thisUpdateCostData.parents('tr').find('td:eq(2)').html(data.action);
    thisUpdateCostData.parents('tr').find('td:eq(3)').text(data.keysearch);
}

function closeModalUpdateCostData() {
    $('#modal-update-cost-data').modal('hide');
    shortcut.remove('F4');
    resetModalUpdateCostData();
}
function resetModalUpdateCostData() {
    $('#modal-update-cost-data select').val(null).trigger('change');
    $('#modal-update-cost-data input').val('');
}
