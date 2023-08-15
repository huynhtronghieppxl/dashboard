let id_update_notification_customer;

async function openModalUpdateNotificationCustomer(r) {
    $('#modal-update-notification-customer').modal('show');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalUpdateNotificationCustomer();
    });
    shortcut.add('ESC', function () {
        closeUpdateNotificationCustomer();
    });
    addLoading('notification.update', '.page-body');

    id_update_notification_customer = await r.attr('data-id');
    $('#title-update-notification-customer').val(r.attr('data-title'));
    $('#content-update-notification-customer').val(r.attr('data-content'));
}

async function saveModalUpdateNotificationCustomer() {
    if(!checkValidateSave($('#modal-update-notification-customer'))) return false;

    $('#btn-save-modal-update-notification-customer').prop('disabled', true);
    shortcut.remove('F4');

    let title = $('#title-update-notification-customer').val(),

        content = $('#content-update-notification-customer').val(),
        check_empty = checkEmptyTemplate('#modal-update-notification-customer'),
        check_des = checkDesTemplate('#modal-update-notification-customer');
    if (check_empty === false || check_des === false){
        $('#btn-save-modal-update-notification-customer').prop('disabled', false);
        shortcut.add('F4', function () {
            saveModalUpdateNotificationCustomer();
        });
        return false;
    }

    let method = 'post',
        url = 'notification.update',
        data = {
            id: id_update_notification_customer,
            title: title,
            content: content
        } ,
        params = null;
    let res = await axiosTemplate(method, url, params, data, [$('#modal-update-notification-customer')]);

    $('#btn-save-modal-update-notification-customer').prop('disabled', false);
    shortcut.add('F4', function () {
        saveModalUpdateNotificationCustomer();
    });

    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        closeUpdateNotificationCustomer();
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeUpdateNotificationCustomer() {
    $('#modal-update-notification-customer').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateNotificationCustomer();
    });

    $('#title-update-notification-customer').val('');
    $('#content-update-notification-customer').val('');
    removeAllValidate();
}

