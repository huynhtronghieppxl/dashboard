async function openModalDetailTimeKeepingManage(r) {
    $('#modal-detail-time-keeping-manage').modal('show');
    shortcut.add('ESC', function () {
        closeModalDetailTimeKeepingManage();
    });
    dateTimePickerHourMinuteTemplate($('#check-in-detail-time-keeping-manage'));
    dateTimePickerHourMinuteTemplate($('#check-out-detail-time-keeping-manage'));
    await getEmployeeLeaveDay(r.data('employee'), r.data('branch'), r.data('date'));
    $('#date-detail-time-keeping-manage').text(r.data('date'));
    $('#work-detail-time-keeping-manage').text(r.data('work-name') + ' (' + r.data('work-open') + '-' + r.data('work-close') + ')');
    $('#late-minute-detail-time-keeping-manage').text(r.data('late-minutes') + ' phút');
    if (r.data('note') === ''){
        $('#note-detail-time-keeping-manage').text('---');
    } else {
        $('#note-detail-time-keeping-manage').text(r.data('note'));
    }
    if (r.data('address') === '') {
        $('#address-check-in-detail-time-keeping-manage').text('---');
    } else {
        $('#address-check-in-detail-time-keeping-manage').text(r.data('address'));
    }
    if (r.data('leave') === 1) {
        if (r.data('leave-salary') === 1) {
            $('#leave-status-detail-time-keeping-manage').text('Không lương');
        }else{
            $('#leave-status-detail-time-keeping-manage').text('Có lương');
        }
    }else{
        $('#leave-status-detail-time-keeping-manage').text('');
    }
}

function closeModalDetailTimeKeepingManage() {
    $('#modal-detail-time-keeping-manage').modal('hide');
    shortcut.add('ESC', function () {
        closeModalDetailTimeKeepingManage();
    });
    reloadModalDetailTimeKeepManage();
}

function reloadModalDetailTimeKeepManage(){
    $('#date-detail-time-keeping-manage').text('---');
    $('#work-detail-time-keeping-manage').text('---');
    $('#late-minute-detail-time-keeping-manage').text('---');
    $('#note-detail-time-keeping-manage').val('');
    $('#leave-status-detail-time-keeping-manage').text('---');
}



