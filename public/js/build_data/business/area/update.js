let thisUpdateAreaData,
    idUpdateAreaData,
    statusUpdateAreaData,
    branchUpdateAreaData,
    checkUpdateAreaData = 0,
    nameUpdateAreaData;

function openModalUpdateAreaData(r) {
    checkUpdateAreaData = 0;
    idUpdateAreaData = r.data('id');
    statusUpdateAreaData = r.data('status');
    branchUpdateAreaData = r.data('branch');
    nameUpdateAreaData = r.data('name');
    thisUpdateAreaData = r;
    $('#modal-update-area-data').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalUpdateAreaData();
    });
    shortcut.add('F4', function () {
        saveUpdateAreaData();
    });
    $('#name-update-area').val(nameUpdateAreaData);
}

async function saveUpdateAreaData() {
    if (checkUpdateAreaData === 1) return false;
    if (!checkValidateSave($('#modal-update-area-data')))return false;
    checkUpdateAreaData = 1;
    let name = $('#name-update-area').val();
    let method = 'post',
        url = 'area-data.update',
        params = null,
        data = {
            id: idUpdateAreaData,
            status: statusUpdateAreaData,
            name: name,
            branch_id: branchUpdateAreaData,
        };

    if(nameUpdateAreaData == name) {
        SuccessNotify($('#success-update-data-to-server').text());
        checkUpdateAreaData = 0;
        closeModalUpdateAreaData();
        return false;
    }

    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-area-data')]);
    checkUpdateAreaData = 0;
    let text = ''
    switch(res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            closeModalUpdateAreaData();
            thisUpdateAreaData.parents('tr').find('td:eq(1)').text(res.data.data.name);
            thisUpdateAreaData.parents('tr').find('td:eq(3)').html(res.data.data.action);
            thisUpdateAreaData.parents('tr').find('td:eq(4)').html(res.data.data.keysearch);
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
            WarningNotify(text);
    }
}

function closeModalUpdateAreaData() {
    $('#modal-update-area-data').modal('hide');
    shortcut.remove("F4");
    shortcut.remove("ESC");
    reloadModalUpdateAreaData()
}

function reloadModalUpdateAreaData(){
    removeAllValidate();
    $('#name-create-area').val('');
}


