let idUpdateShiftData, checkSaveUpdateShiftData, thisUpdateShiftData;

function openModalUpdateShiftData(r) {
    thisUpdateShiftData = r;
    checkSaveUpdateShiftData = 0;
    idUpdateShiftData = r.data('id');
    $('#shift-data-update-name').val(r.data('name'));
    $('#to-hour-update-shift-data').val(r.data('to-hour'));
    $('#from-hour-update-shift-data').val(r.data('from-hour'));
    $('#modal-update-shift-data').modal('show');
    addLoading("shift-data.update", 'loading-update-shift-data');
    shortcut.remove('F2');
    shortcut.add("ESC", function () {
        closeModalUpdateShiftData();
    });
    shortcut.add("F4", function () {
        saveUpdateShiftData();
    });
    $("#modal-update-shift-data input").on("click", function () {
        $(this).select();
    });
    dateTimePickerHourMinuteTemplate($('#to-hour-update-shift-data'));
    dateTimePickerHourMinuteTemplate($('#from-hour-update-shift-data'));
}

function timeToDecimal(t) {
    t = t.split(':');
    return parseFloat(parseInt(t[0], 10) + parseInt(t[1], 10)/60).toFixed(2);
}

async function saveUpdateShiftData() {
    if (checkSaveUpdateShiftData === 1) return false;
    if (!checkValidateSave($('#modal-update-shift-data'))) return false;
    let name = $('#shift-data-update-name').val(),
        to_hour = $('#to-hour-update-shift-data').val(),
        from_hour = $('#from-hour-update-shift-data').val();
    let start = $('#from-hour-update-shift-data').val(),
        end = $('#to-hour-update-shift-data').val();
    if (formatNumber(timeToDecimal(start)) == formatNumber(timeToDecimal(end))) {
        addErrorInput($('#to-hour-update-shift-data'), 'Giờ kết thúc không được bằng giờ bắt đầu !')
        return false;
    }
    checkSaveUpdateShiftData = 1;
    let method = 'POST',
        url = 'shift-data.update',
        params = null,
        data = {
            id: idUpdateShiftData,
            name: name,
            from_hour: from_hour,
            to_hour: to_hour,
        };
    let res = await axiosTemplate(method, url, params, data,[$('#loading-modal-create-employee-manage')]);
    checkSaveUpdateShiftData = 0;
    let text= '';
    switch (res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            closeModalUpdateShiftData();
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function (){
                openModalCreateShiftData()
            })
            drawDataUpdateShiftData(res.data.data);
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

function drawDataUpdateShiftData(data) {
    thisUpdateShiftData.parents('tr').find('td:eq(1)').text(data.name);
    thisUpdateShiftData.parents('tr').find('td:eq(2)').text(data.time_interval_string);
    thisUpdateShiftData.parents('tr').find('td:eq(3)').html(data.action);
}

function closeModalUpdateShiftData() {
    $('#modal-update-shift-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateShiftData();
    })
    reloadModalUpdateShiftData();
}

function reloadModalUpdateShiftData(){
    $('#shift-data-update-name').val('');
    $('#to-hour-update-shift-data').val(moment().format('HH:mm'));
    $('#from-hour-update-shift-data').val(moment().format('HH:mm'));
}

