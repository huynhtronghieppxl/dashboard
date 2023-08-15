let checkSaveCreateRevenueData = 0,
    checkGetDataTypeRevenueData = 0;

$(function () {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateRevenueData();
    });
})

function openModalCreateRevenueData() {
    $('#modal-revenue-data-create').modal('show');
    $('#select-revenue-data-create').select2({
        dropdownParent: $('#modal-revenue-data-create'),
    })
    shortcut.add('F4', function () {
        saveCreateRevenueData();
    })
    shortcut.add('ESC', function () {
        closeModalCreateRevenueData();
    })
    shortcut.remove('F2');
    getDataTypeRevenueData();
    $('#modal-revenue-data-create input').on('input', function () {
        $('#modal-revenue-data-create .btn-renew').removeClass('d-none')
    })
    $('#modal-revenue-data-create select').on('change', function () {
        $('#modal-revenue-data-create .btn-renew').removeClass('d-none')
    })
}

async function getDataTypeRevenueData() {
    if (checkGetDataTypeRevenueData === 1) return false;
    let method = 'get',
        url = 'revenue-data.cost-type',
        params = null,
        data = {};
    let res = await axiosTemplate(method, url, params, data, [$('#select-revenue-data-create')]);
    $('#select-revenue-data-create').html(res.data[0]);
    checkGetDataTypeRevenueData = 1;
}

async function saveCreateRevenueData() {
    if (checkSaveCreateRevenueData === 1) return false;
    if (!checkValidateSave($('#modal-revenue-data-create'))) return false
    let addition_fee_reason_type_id = $('#select-revenue-data-create').find(':selected').val();
    let name = $('#revenue-data-name-create').val();
    checkSaveCreateRevenueData = 1;
    let method = 'post',
        url = 'revenue-data.create',
        params = null,
        data = {
            name: name,
            // addition_fee_reason_type_id: addition_fee_reason_type_id
        };
    let res = await axiosTemplate(method, url, params, data, [$('#modal-content-create')]);
    checkSaveCreateRevenueData = 0;
    let text = $('#success-create-data-to-server').html();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalCreateRevenueData();
            drawCreateRevenueData(res.data.data);
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

function drawCreateRevenueData(data) {
    $('#total-record-enable').text(Number(removeformatNumber($('#total-record-enable').text())) + 1)
    addRowDatatableTemplate(tableEnableRevenueData, {
        'name': data.name,
        // 'addition_fee_reason_type_name': data.addition_fee_reason_type_name,
        'action': data.action,
        'keysearch': data.keysearch,
    });
}

function closeModalCreateRevenueData() {
    $('#modal-revenue-data-create').modal('hide');
    resetModalCreateRevenueData();
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateRevenueData();
    });
}

function resetModalCreateRevenueData() {
    $('#select-revenue-data-create').val($('#select-revenue-data-create').find('option:first-child').val()).trigger('change.select2');
    $('#modal-revenue-data-create input').val('');
    $('#modal-revenue-data-create .btn-renew').addClass('d-none')
}
