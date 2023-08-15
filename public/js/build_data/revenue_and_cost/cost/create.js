let checkSaveCreateCostData = 0;

$(function () {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateCostData();
    });
})

function openModalCreateCostData() {
    checkSaveCreateCostData = 0;
    $('#select-create-cost-data').select2({
        dropdownParent: $('#modal-create-cost-data'),
    })
    $('#modal-create-cost-data').modal('show');

    $('#modal-create-cost-data').on('shown.bs.modal', function () {
        $('#cost-data-name-create').focus();
    })

    shortcut.add('F4', function () {
        saveCreateCostData();
    })
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCreateCostData();
    })
    shortcut.remove('F2');
    $('#modal-create-cost-data select').on('change', function () {
        $('#modal-create-cost-data .btn-renew').removeClass('d-none')
    })
    $('#cost-data-name-create').on('keydown', function (e){
        if (e.key === 13){
            $('#select-create-cost-data').select();
        }
    })
}

async function saveCreateCostData() {
    if (checkSaveCreateCostData === 1) return false;
    if (!checkValidateSave($('#modal-create-cost-data'))) return false;
    let name = $('#cost-data-name-create').val();
    checkSaveCreateCostData = 1;
    let method = 'post',
        url = 'cost-data.create',
        params = null,
        data = {
            name: name,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#modal-content-create')]);
    checkSaveCreateCostData = 0;
    let text = $('#success-create-data-to-server').html();

    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalCreateCostData();
            drawCreateCostData(res.data.data);
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            ErrorNotify(text);
            break;
        default :
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function drawCreateCostData(data) {
    $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
    addRowDatatableTemplate(tableCostData, {
        'name': data.name,
        'addition_fee_reason_type_name': data.addition_fee_reason_type_name,
        'action': data.action,
        'keysearch': data.keysearch,
    });
}

function closeModalCreateCostData() {
    $('#modal-create-cost-data').modal('hide');

    resetModalCreateCostData();
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateCostData();
    });
}

function resetModalCreateCostData() {
    removeAllValidate();
    $('#modal-create-cost-data input').val('')
    $('#modal-create-cost-data select').val(null).trigger('change');
    $('#modal-create-cost-data .btn-renew').addClass('d-none')
}

