let checkSaveCreateWageData = 0;

function openModalCreateWageData() {
    checkSaveCreateWageData = 0;
    $('#modal-create-wage-data').modal('show');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalCreateWageData();
    })
    shortcut.add('F4', function () {
        saveCreateWageData();
    });
    $('#modal-create-wage-data input').on('input', function (){
        $('#modal-create-wage-data .btn-renew').removeClass('d-none');
    });
}

async function saveCreateWageData() {
    if (checkSaveCreateWageData === 1) return false;
    if (!checkValidateSave($("#modal-create-wage-data"))) return false;
    checkSaveCreateWageData = 1;
    let level = $('#level-name-wage-data').val(),
        salary = $('#exchange-money-wage-data').val(),
        method = 'post',
        url = 'wage-data.create',
        params = null,
        data = {
            level: level,
            basic_salary: removeformatNumber(salary),
        };
    let res = await axiosTemplate(method, url, params, data,[$('#loading-create-wage-data')]);
    checkSaveCreateWageData = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            closeModalCreateWageData();
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function (){
                openModalCreateWageData();
            })
            drawDataCreateWageData(res.data.data);
            $('#total-record-enable').text(parseInt($('#total-record-enable').text())+1)
            break;
        case 500:
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
            break;
        default:
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function drawDataCreateWageData(data) {
    addRowDatatableTemplate(tableWageData, {
        'level': data.level,
        'basic_salary': data.basic_salary,
        'action': data.action,
        'keysearch': '',
    });
}

function closeModalCreateWageData() {
    $('#modal-create-wage-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateWageData()
    })
    reloadModalCreateWageData()
}

function reloadModalCreateWageData(){
    $('#level-name-wage-data').val('');
    $('#exchange-money-wage-data').val(100);
    $('#modal-create-wage-data .btn-renew').addClass('d-none');
}
