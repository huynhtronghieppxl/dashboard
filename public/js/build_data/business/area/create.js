let checkSaveCreateAreaData;

async function openModalCreateAreaData() {
    $('#modal-create-area-data').modal('show');
    shortcut.remove("F2");
    shortcut.add('ESC', function () {
        closeModalCreateAreaData();
    });
    shortcut.add('F4', function () {
        saveCreateAreaData();
    });
    $('#select-branch-area').select2({
        dropdownParent: $('#modal-create-area-data'),
    });
    $('#select-branch-area').val($('.select-branch-area-data').val()).trigger('change');
    $('#modal-create-area-data input').on('input', function () {
        $('#modal-create-area-data .btn-renew').removeClass('d-none')
    })
}

async function saveCreateAreaData() {
    if (checkSaveCreateAreaData === 1) return false;
    if (!checkValidateSave($('#modal-create-area-data'))) return false;
    let name = $('#name-create-area').val(),
        branch = $('.select-branch-area-data').val();
    checkSaveCreateAreaData = 1;
    let method = 'post',
        url = 'area-data.create',
        params = null,
        data = {
            name: name,
            branch_id: branch,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-area-data')]);
    checkSaveCreateAreaData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalCreateAreaData();
            addRowDatatableTemplate(tableEnableAreaData, {
                'name': res.data.data.name,
                'active_count': res.data.data.active_count,
                'action': res.data.data.action,
                'keysearch': res.data.data.keysearch,
            });
            $('#total-record-enable').text(Number($('#total-record-enable').text()) + 1);
            break;
        case 500:
            ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            break;
    }
}

function closeModalCreateAreaData() {
    $('#modal-create-area-data').modal('hide');
    shortcut.remove("ESC");
    shortcut.remove("F4");
    shortcut.add('F2', function () {
        openModalCreateAreaData();
    });
    reloadModalCreateAreaData();
}

function reloadModalCreateAreaData() {
    removeAllValidate();
    $('#name-create-area').val('')
    $('#modal-create-area-data .btn-renew').addClass('d-none')
}



