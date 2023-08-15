let checkSaveTimeKeepingManage = 0,
    employeeUpdateTimeKeepingManage,
    idUpdateTimeKeepingManage;

async function openModalUpdateTimeKeepingManage(r) {
    if (r.attr('data-work-name') == '') {
        let title = 'Nhân viên chưa có ca làm việc!',
            content = '',
            icon = 'warning';
        sweetAlertNotifyComponent(title, content, icon);
    } else {
        checkSaveTimeKeepingManage = 0;
        $('#modal-update-time-keeping-manage').modal('show');
        shortcut.add('F4', function () {
            saveModalUpdateTimeKeepingManage();
        });
        shortcut.add('ESC', function () {
            closeModalUpdateTimeKeepingManage();
        });
        $('#check-in-update-time-keeping-manage').val('00:00');
        $('#check-out-update-time-keeping-manage').val('00:00');
        dateTimePickerHourMinuteTemplate($('#check-in-update-time-keeping-manage'));
        dateTimePickerHourMinuteTemplate($('#check-out-update-time-keeping-manage'));
        employeeUpdateTimeKeepingManage = r.attr('data-employee');
        idUpdateTimeKeepingManage = r.attr('data-id');
        $('#date-update-time-keeping-manage').text(r.attr('data-date'));
        if (r.attr('data-session-time') !== '') {
            $('#work-update-time-keeping-manage').text(r.attr('data-work-name') + ' (' + r.attr('data-session-time') + ')');
        } else {
            $('#work-update-time-keeping-manage').text(r.attr('data-work-name') + ' (' + r.attr('data-work-open') + '-' + r.attr('data-work-close') + ')');
        }
        $('#late-minute-update-time-keeping-manage').text(r.attr('data-late-minutes'));
        $('#note-update-time-keeping-manage').val(r.attr('data-note'));
        countCharacterTextarea()
        if (r.attr('data-address') === '') {
            $('#address-check-in-time-keeping-manage').text('---');
        } else {
            $('#address-check-in-time-keeping-manage').text(r.attr('data-address'));
        }
        if (r.data('leave') === 1) {
            $('#check-in-update-time-keeping-manage').val('00:00');
            $('#check-out-update-time-keeping-manage').val('00:00');
            if (r.data('leave-salary') === 1) {
                $('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping][value="2"]').prop('checked', true);
                $('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping][value="0"]').prop('checked', false);
                $('#time-checkin-in-out').addClass('d-none')
            } else {
                $('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping][value="3"]').prop('checked', true);
                $('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping][value="0"]').prop('checked', false);

                $('#time-checkin-in-out').addClass('d-none')
            }
        } else if (r.data('leave') === 0 && r.data('leave-salary') === 0 && (r.data('check-in') === '' || r.data('check-in') === '00:00')) {
            $('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping][value="1"]').prop('checked', true);
            $('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping][value="0"]').prop('checked', false);
            $('#time-checkin-in-out').addClass('d-none')
        } else {
            let check_out_time = r.data('check-out');
            $('#check-in-update-time-keeping-manage').val(r.data('check-in'));
            $('#check-out-update-time-keeping-manage').val(check_out_time.slice(check_out_time.length - 5));
            $('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping][value="0"]').prop('checked', true);
            $('#time-checkin-in-out').removeClass('d-none')

        }
        $('#check-in-update-time-keeping-manage, #check-out-update-time-keeping-manage').parent('div').removeClass('border-danger');
        $('#check-in-update-time-keeping-manage, #check-out-update-time-keeping-manage').on('focusout', function () {
            let late_before = calculateHourMinute(r.data('work-open'), $('#check-in-update-time-keeping-manage').val());
            $('#late-minute-update-time-keeping-manage').text(late_before);
        });

        $('#check-in-update-time-keeping-manage').datetimepicker().on('dp.change', function (event) {
            let late_before = calculateHourMinute(r.data('work-open'), $('#check-in-update-time-keeping-manage').val());
            $('#late-minute-update-time-keeping-manage').text(late_before);
        });
        $('#check-out-update-time-keeping-manage').datetimepicker().on('dp.change', function (event) {
            if (!event.date) {
                $('#check-out-update-time-keeping-manage').val('');
            }
        });
        $('.chb').change(function () {
            $('.chb').not(this).prop('checked', false);
        });
        await getEmployeeLeaveDay(r.data('employee'), r.data('branch'), r.data('date'));
    }
    $('#check-in-update-time-keeping-manage, #check-out-update-time-keeping-manage').on('click', function () {
        $(this).parent('div').removeClass('border-danger')
    })
    $('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping]').on('click', function () {
        if ($('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping]:checked').val() == 0) {
            $('#time-checkin-in-out').removeClass('d-none')
        } else {
            $('#time-checkin-in-out').addClass('d-none')
        }
    })
}

async function getEmployeeLeaveDay(employee_id, branch_id, time) {
    let method = 'get',
        url = 'time-keeping-manage.get-employee-leave-day',
        params = {
            employee_id: employee_id,
            branch_id: branch_id,
            time: time
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-update-time-keeping-manage'),
        $('#loading-modal-detail-time-keeping-manage'),
    ]);
    let text = '';
    switch (res.data.status) {
        case 200:
            if (res.data.data.employee_salary_table_status != 5 || res.data.data.employee_salary_table_status != 6) {
                if (res.data.data.total_leave_day_with_salary_avalible_can_used <= 0) {
                    $('#leave-salary-update-time-keeping-manage').prop('disabled', true);
                    $('#leave-salary-update-time-keeping-manage').attr('style', "cursor: no-drop!important;");
                    $('#leave-salary-update-time-keeping-manage').parents('.checkbox-form-group').find('label').attr('style', "cursor: no-drop!important;");
                    $('#leave-salary-update-time-keeping-manage').parents('.checkbox-form-group').addClass('disabled');
                    $('#noti-leave-salary-update-time-keeping-manage').removeClass('d-none');
                    $('#noti-leave-salary-update-time-keeping-manage').text('Nhân viên này đã hết số ngày nghỉ phép có lương trong tháng này!');
                } else {
                    $('#leave-salary-update-time-keeping-manage').prop('disabled', false);
                    $('#leave-salary-update-time-keeping-manage').attr('style', "cursor: pointer !important;");
                    $('#leave-salary-update-time-keeping-manage').parents('.checkbox-form-group').find('label').attr('style', "cursor: pointer!important;");
                    $('#leave-salary-update-time-keeping-manage').parents('.checkbox-form-group').removeClass('disabled');
                    $('#noti-leave-salary-update-time-keeping-manage').addClass('d-none');
                    $('#noti-leave-salary-update-time-keeping-manage').text('');
                }
            } else {
                let title = 'Tháng này đã chốt lương!',
                    content = 'Bạn không thể chỉnh sửa chấm công của nhân viên trong tháng này',
                    icon = 'warning';
                sweetAlertNotifyComponent(title, content, icon);
                closeModalUpdateTimeKeepingManage();
            }
            break;
        case 500:
            $('#leave-salary-update-time-keeping-manage').prop('disabled', true);
            $('#noti-leave-salary-update-time-keeping-manage').removeClass('d-none');
            $('#noti-leave-salary-update-time-keeping-manage').text('Nhân viên này đã hết số ngày nghỉ phép có lương trong tháng này!');
            break;
        default:
            $('#leave-salary-update-time-keeping-manage').prop('disabled', true);
            $('#noti-leave-salary-update-time-keeping-manage').removeClass('d-none');
            $('#noti-leave-salary-update-time-keeping-manage').text('Nhân viên này đã hết số ngày nghỉ phép có lương trong tháng này!');
    }
}

async function saveModalUpdateTimeKeepingManage() {
    if (checkSaveTimeKeepingManage !== 0) {
        return false;
    }
    if ($('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping]:checked').val() == 0) {
        if (!checkValidateSave($('#modal-update-time-keeping-manage'))) return false;
    }

    let time_check_out = ($('#check-out-update-time-keeping-manage').val()).slice(0, 2);
    let date_check_out = $('#date-update-time-keeping-manage').text();
    if (0 < parseInt(time_check_out) <= 3) {
        date_check_out = moment(date_check_out, 'DD/MM/YYYY').add(1, 'days').format('DD/MM/YYYY');
    }
    let branch = $('.select-branch-time-keeping-data').val(),
        note = $('#note-update-time-keeping-manage').val(),
        check_in = $('#date-update-time-keeping-manage').text() + ' ' + $('#check-in-update-time-keeping-manage').val(),
        check_out = date_check_out + ' ' + $('#check-out-update-time-keeping-manage').val(),
        date = $('#date-update-time-keeping-manage').text(),
        is_leave_day = 0,
        is_leave_day_without_salary = 0;
    if ($('#check-in-update-time-keeping-manage').val() === '') check_in = '';
    if ($('#check-out-update-time-keeping-manage').val() === '') check_out = '';
    if ($('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping]:checked').val() == 2) {
        is_leave_day = 1;
        is_leave_day_without_salary = 1;
        check_in = $('#date-update-time-keeping-manage').text() + ' 00:00';
        check_out = $('#date-update-time-keeping-manage').text() + ' 00:00';
    }
    if ($('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping]:checked').val() == 3) {
        is_leave_day = 1;
        is_leave_day_without_salary = 0;
        check_in = $('#date-update-time-keeping-manage').text() + ' 00:00';
        check_out = $('#date-update-time-keeping-manage').text() + ' 00:00';
    }
    if ($('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping]:checked').val() == 1) {
        is_leave_day = 0;
        is_leave_day_without_salary = 0;
        check_in = $('#date-update-time-keeping-manage').text() + ' 00:00';
        check_out = $('#date-update-time-keeping-manage').text() + ' 00:00';
    }
    if ($('#check-timekeeping-update-time-keeping-manage input[name=check-timekeeping-update-time-keeping]:checked').val() == 0) {
        is_leave_day = 0;
        is_leave_day_without_salary = 0;
        check_in = $('#date-update-time-keeping-manage').text() + ' ' + $('#check-in-update-time-keeping-manage').val();
        if ($('#check-out-update-time-keeping-manage').val()) {
            check_out = $('#date-update-time-keeping-manage').text() + ' ' + $('#check-out-update-time-keeping-manage').val();
        } else {
            check_out = null;
        }
        let input_time = $('#check-in-update-time-keeping-manage').val();
        if (input_time === '00:00') {
            $('#check-in-update-time-keeping-manage, #check-out-update-time-keeping-manage').parent('div').addClass('border-danger');
            return false;

        }
    }
    checkSaveTimeKeepingManage = 1;
    let method = 'post',
        url = 'time-keeping-manage.update',
        params = null,
        data = {
            branch: branch,
            id: idUpdateTimeKeepingManage,
            employee_id: employeeUpdateTimeKeepingManage,
            checkin_time: check_in,
            checkout_time: check_out,
            checkin_day: date,
            is_leave_day: is_leave_day,
            is_leave_day_without_salary: is_leave_day_without_salary,
            note: note,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-update-time-keeping-manage')
    ]);
    checkSaveTimeKeepingManage = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = 'Chỉnh sửa chấm công thành công !';
            SuccessNotify(text);
            checkSaveTimeKeepingManage = 0;
            await closeModalUpdateTimeKeepingManage();
            dataMonthTimeKeepingManage();
            break;
        case 500:
            checkSaveTimeKeepingManage = 0;
            ErrorNotify((res.data.message !== null) ? res.data.message : 'Chỉnh sửa chấm công thất bại !');
            ErrorNotify(text);
            break;
        default:
            checkSaveTimeKeepingManage = 0;
            WarningNotify((res.data.message !== null) ? res.data.message : 'Chỉnh sửa chấm công thất bại !');
    }
}

function closeModalUpdateTimeKeepingManage() {
    $('#modal-update-time-keeping-manage').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    reloadModalUpdateTimeKeepingManage();
    countCharacterTextarea()
}

function reloadModalUpdateTimeKeepingManage() {
    $('#leave-update-time-keeping-manage').prop('checked', false);
    $('#leave-salary-update-time-keeping-manage').prop('checked', false);
    $('#leave-salary-update-time-keeping-manage').prop('disabled', false);
    $('#leave-update-time-keeping-manage').prop('disabled', false);
    $('#leave-salary-update-time-keeping-manage').parent('label').attr('style', "cursor: pointer!important;");
    $('#leave-salary-update-time-keeping-manage').parent('label').children('span').attr('style', "cursor: pointer!important;");
    $('#leave-update-time-keeping-manage').parent('label').attr('style', "cursor: pointer!important;");
    $('#leave-update-time-keeping-manage').parent('label').children('span').attr('style', "cursor: pointer!important;");
    $('#noti-leave-salary-update-time-keeping-manage').addClass('d-none');
    $('#noti-leave-salary-update-time-keeping-manage').text('');
    $('#check-in-update-time-keeping-manage').val('');
    $('#check-out-update-time-keeping-manage').val('');
    $('#date-update-time-keeping-manage').html('---');
    $('#work-update-time-keeping-manage').html('---');
    $('#check-in-update-time-keeping-manage').val('00:00');
    $('#check-out-update-time-keeping-manage').val('00:00');
    $('#note-update-time-keeping-manage').html('');
    $('#late-minute-update-time-keeping-manage').html('---');
    $('#leave-update-time-keeping-manage').prop('checked', false);
}

