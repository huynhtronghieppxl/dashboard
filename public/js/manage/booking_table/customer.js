let saveCreateCustomerBookingTableManage = 0;

async function saveModalCreateCustomerBookingTableManage() {
    if(!checkValidateSave($('#modal-create-customer-booking-table-manage'))) return false;
    if (saveCreateCustomerBookingTableManage === 1) {
        return false;
    }
    saveCreateCustomerBookingTableManage = 1;

    let check_input = checkCustomerEmptyTemplate('#modal-create-customer-booking-table-manage');
    if (check_input === false){
        saveCreateCustomerBookingTableManage = 0;
        return false;
    }

    let method = 'post',
        url = 'booking-table-manage.customer',
        phone = $('#phone-create-customer-booking-table-manage').val(),
        last_name = $('#last-name-create-customer-booking-table-manage').val(),
        first_name = $('#first-name-create-customer-booking-table-manage').val(),
        birthday = $('#birthday-create-customer-booking-table-manage').val(),
        address = $('#address-create-customer-booking-table-manage').val(),
        params = null,
        data = {
            phone: phone,
            last_name: last_name,
            first_name: first_name,
            birthday: birthday,
            address: address
        };
    let res = await axiosTemplate(method, url, params, data);
    let text = '';
    switch(res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            $('#customer-phone-create-booking-table-manage').val(res.data.data.phone);
            $('#customer-name-create-booking-table-manage').text(res.data.data.name);
            $('#customer-name-create-booking-table-manage').data('lastname',res.data.data.last_name);
            $('#customer-name-create-booking-table-manage').data('firstname',res.data.data.first_name);
            $('#customer-phone-create-booking-table-manage').data('id', res.data.data.id);
            searchCustomerBookingTableManage();
            closeModalCreateCustomerBookingTableManage();
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
            saveCreateCustomerBookingTableManage = 0;
    }
}

function closeModalCreateCustomerBookingTableManage() {
    shortcut.add('ESC', function () {
        closeModalCreateBookingTableManage();
    });
    shortcut.add('F4', function () {
        saveModalCreateBookingTableManage();
    });
    reloadModalCreateCustomerBookingTableManage()
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        container: 'body',
        html: true
    });
}

function reloadModalCreateCustomerBookingTableManage(){
    $('#phone-create-customer-booking-table-manage').val('');
    $('#last-name-create-customer-booking-table-manage').val('');
    $('#first-name-create-customer-booking-table-manage').val('');
    $('#address-create-customer-booking-table-manage').val('');
    $('#modal-create-customer-booking-table-manage').modal('hide');
    saveCreateCustomerBookingTableManage = 0;
}
