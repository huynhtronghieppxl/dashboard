function openModalCreateNotificationCustomer() {
    $('#modal-create-notification-customer').modal('show');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalCreateNotificationCustomer();
    });
    shortcut.add('ESC', function () {
        closeCreateNotificationCustomer();
    });
    addLoading('notification.create', '.page-body');
}

async function saveModalCreateNotificationCustomer() {
    if(!checkValidateSave($('#modal-create-notification-customer'))) return false;
    $('#btn-save-modal-create-notification-customer').prop('disabled', true);
    shortcut.remove('F4');

    let title = $('#title-create-notification-customer').val(),
        content = $('#content-create-notification-customer').val(),
        check_empty = checkEmptyTemplate('#modal-create-notification-customer'),
        check_des = checkDesTemplate('#modal-create-notification-customer');
    if (check_empty === false || check_des === false){
        $('#btn-save-modal-create-notification-customer').prop('disabled', false);
        shortcut.add('F4', function () {
            saveModalCreateNotificationCustomer();
        });
        return false;
    }

    let method = 'post',
        url = 'notification.create',
        data = {
            title: title,
            content: content
        } ,
        params = null;
    let res = await axiosTemplate(method, url, params, data, [$('#modal-create-notification-customer')]);

    $('#btn-save-modal-create-notification-customer').prop('disabled', false);
    shortcut.add('F4', function () {
        saveModalCreateNotificationCustomer();
    });

    if (res.data.status === 200) {
        SuccessNotify($('#success-create-data-to-server').text());
        closeCreateNotificationCustomer();
        loadData();
    } else {
        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}

function closeCreateNotificationCustomer() {
    $('#modal-create-notification-customer').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateNotificationCustomer();
    });

    $('#title-create-notification-customer').val('');
    $('#content-create-notification-customer').val('');
    removeAllValidate();
}

