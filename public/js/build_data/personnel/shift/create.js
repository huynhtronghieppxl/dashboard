let checkSaveCreateShiftData;

function openModalCreateShiftData() {
    checkSaveCreateShiftData = 0;
    $('#modal-create-shift-data').modal('show');
    addLoading("shift-data.create", 'loading-create-shift-data');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalCreateShiftData();
    });
    shortcut.add('ESC', function () {
        closeModalCreateShiftData();
    });
    dateTimePickerHourMinuteTemplate($('#from-hour-shift-data'));
    dateTimePickerHourMinuteTemplate($('#to-hour-shift-data'));
    $('#modal-create-shift-data input').on('keyup', function () {
        $('#modal-create-shift-data  .btn-renew').removeClass('d-none')
    })

    $('#from-hour-shift-data').on('dp.change', function () {
        $('#modal-create-shift-data .btn-renew').removeClass('d-none')
    })
    $('#to-hour-shift-data').on('dp.change', function () {
        $('#modal-create-shift-data .btn-renew').removeClass('d-none')
    })
}

function timeToDecimal(t) {
    t = t.split(':');
    return parseFloat(parseInt(t[0], 10) + parseInt(t[1], 10)/60).toFixed(2);
}

async function saveModalCreateShiftData() {
    if (checkSaveCreateShiftData === 1) return false;
    if (!checkValidateSave($('#modal-create-shift-data'))) return false;
    let name = $('#shift-data-name').val(),
        brand_id = $('.select-brand.shift-data').val(),
        to_hour = $('#to-hour-shift-data').val(),
        form_hour = $('#from-hour-shift-data').val();
    let start = $('#from-hour-shift-data').val(),
        end = $('#to-hour-shift-data').val();

    if ((timeToDecimal(start)) === (timeToDecimal(end))) {
        addErrorInput($('#to-hour-shift-data'), 'Giờ kết thúc không được bằng giờ bắt đầu !')
        return false;
    }
    checkSaveCreateShiftData = 1;
    let method = 'post',
        url = 'shift-data.create',
        params = null,
        data = {
            brand_id: brand_id,
            name: name,
            to_hour: to_hour,
            form_hour: form_hour,
        };
    let res = await axiosTemplate(method, url, params, data,[$('#loading-create-shift-data')]);
    checkSaveCreateShiftData = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            closeModalCreateShiftData();
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function (){
                openModalCreateShiftData()
            })
            drawDataCreateShiftData(res.data.data);
            loadData();
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

function drawDataCreateShiftData(data) {
    $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1))
    addRowDatatableTemplate(tableEnableShiftData, {
        'name': data.name,
        'time_interval_string': data.time_interval_string,
        'action': data.action,
        'keysearch': data.keysearch,
    });
}

function closeModalCreateShiftData() {
    $('#modal-create-shift-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateShiftData()
    })
    reloadModalCreateShiftData();
}

function reloadModalCreateShiftData(){
    removeAllValidate();
    $('#shift-data-name').val('');
    $('#to-hour-shift-data').val(moment().format('HH:mm'));
    $('#from-hour-shift-data').val(moment().format('HH:mm'));
    $('#modal-create-shift-data .btn-renew').addClass('d-none');
}

