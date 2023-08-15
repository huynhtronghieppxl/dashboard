async function dataSettingBookingManage() {
    $('#modal-setting-booking-table-manage').modal('show');
    $('#check-setting-booking-table-manage').on('change', function () {
        if ($(this).is(':checked') === true) {
            $('#btn-save-setting-booking-table-manage').removeClass('d-none');
            shortcut.remove('F4');
        } else {
            $('#btn-save-setting-booking-table-manage').addClass('d-none');
            shortcut.add('F4', function () {
                saveModalSettingBookingManage();
            });
        }
    })
}

async function CheckBooking(){
    if ($('#change_branch').find(':selected').data('booking') === 1) {
        $('#data-visible-booking-manage').removeClass('d-none');
    } else {
        $('#data-visible-booking-manage').addClass('d-none');
        dataSettingBookingManage();
    }
}

async function saveModalSettingBookingManage() {

    let method = 'post',
        url = 'booking-table-manage.setting',
        branch = branch_id,
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    let text = '';
    switch (res.data.status){
        case 200:
            $('#data-visible-booking-manage').removeClass('d-none');
            location.href = '/booking-table-manage';
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
            break;

    }
}
function closeModalSettingBookingManage() {
    $('#modal-setting-booking-table-manage').modal('hide');
    focus_status_booking_manage = 1;
    clickOffStatusBranch.click();
    focus_status_booking_manage = 0;
}
