let checkSaveCreateCustomerGiftMarketing = 0, checkDataGiftCreateCustomerGiftMarketing = 0,
    checkSaveSearchCustomerGiftMarketing = 0;

function openModalCreateCustomerGiftMarketing() {
    $('#modal-create-customer-gift-marketing').modal('show');
    addLoading("customer-gift-marketing.create", 'loading-create-customer-gift-marketing');
    addLoading("customer-gift-marketing.phone", 'loading-create-customer-gift-marketing');
    addLoading("customer-gift-marketing.gift", 'loading-create-customer-gift-marketing');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalCreateCustomerGiftMarketing();
    });
    shortcut.add('ESC', function () {
        closeModalCreateCustomerGiftMarketing();
    });
    $('#modal-create-customer-gift-marketing .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-customer-gift-marketing')
    });
    $('#search-btn-customer-create-cards').unbind('click').on('click', function () {
        searchCustomerCreateCustomerGiftMarketing();
    })
    $('#phone-create-customer-gift-marketing').unbind('input paste').on('input paste', function () {
        if ($('#phone-create-customer-gift-marketing').val().length >= 10 && $('#phone-create-customer-gift-marketing').val().substring(0, 2).match(/^(09|03|07|08|05).*$/)) {
            searchCustomerCreateCustomerGiftMarketing();
        }
    });
    $('#modal-create-customer-gift-marketing input').on('focus', function () {
        $(this).select();
    });
    $('#type-create-customer-gift-marketing input').on('click', function () {
        if ($(this).val() === '0') {
            $('#phone-create-customer-gift-marketing').parents('.form-group').addClass('d-none');
            $('#name-create-customer-gift-marketing').parents('.form-group').addClass('d-none');
        } else {
            $('#phone-create-customer-gift-marketing').parents('.form-group').removeClass('d-none');
            $('#name-create-customer-gift-marketing').parents('.form-group').removeClass('d-none');
        }
    })
    loadDataGiftCreateCustomerGiftMarketing();
}

async function loadDataGiftCreateCustomerGiftMarketing() {
    if (checkDataGiftCreateCustomerGiftMarketing === 0) {
        let brand = $('#restaurant-branch-id-selected span').attr('data-value');
        let method = 'get',
            url = 'customer-gift-marketing.gift',
            params = {
                brand: brand,
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        checkDataGiftCreateCustomerGiftMarketing = 1;
        $('#select-gift-create-customer-gift-marketing').html(res.data[0]);
    }
}

async function searchCustomerCreateCustomerGiftMarketing() {
    if (checkSaveSearchCustomerGiftMarketing === 1) return false;
        let method = 'post',
        url = 'customer-gift-marketing.customer',
        params = null,
        data = {phone: $('#phone-create-customer-gift-marketing').val()};
    checkSaveSearchCustomerGiftMarketing = 1;
    let res = await axiosTemplate(method, url, params, data);
    checkSaveSearchCustomerGiftMarketing = 0;
    if (res.data.status === 200) {
        $('#name-create-customer-gift-marketing').text(res.data.data.name);
        $('#phone-create-customer-gift-marketing').data('id', res.data.data.id);
    } else {
        $('#name-create-customer-gift-marketing').text('');
        $('#phone-create-customer-gift-marketing').data('id', '');
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

async function saveModalCreateCustomerGiftMarketing() {
    if (checkSaveCreateCustomerGiftMarketing === 1) return false;
    let customer = ($('#type-create-customer-gift-marketing input:checked').val() === '0') ? -1 : $('#phone-create-customer-gift-marketing').data('id'),
        gift = $('#select-gift-create-customer-gift-marketing').val(),
        brand = $('#restaurant-branch-id-selected span').attr('data-value');
    let method = 'post',
        url = 'customer-gift-marketing.create',
        params = null,
        data = {
            customer: customer,
            brand: brand,
            gift: gift,
        };
    checkSaveCreateCustomerGiftMarketing = 1;
    let res = await axiosTemplate(method, url, params, data);
    checkSaveCreateCustomerGiftMarketing = 0;
    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        closeModalCreateCustomerGiftMarketing();
        if(customer === -1){
            loadData();
        } else {
            drawDataCreateCustomerGiftMarketing(res.data.data);
        }
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function drawDataCreateCustomerGiftMarketing(data) {
    $('#total-record-not-use').text(formatNumber(removeformatNumber($('#total-record-not-use').text()) + 1));
    addRowDatatableTemplate(tableNotUseCustomerGiftMarketing, {
        'customer_name': data.customer_name,
        'customer_phone': data.customer_phone,
        'name': data.name,
        'open': data.open,
        'description': data.description,
        'type': data.type,
        'value': data.value,
        'quantity': data.quantity,
        'created_at': data.created_at,
        'expire_at': data.expire_at,
    });
}

function closeModalCreateCustomerGiftMarketing() {
    $('#modal-create-customer-gift-marketing').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateCustomerGiftMarketing();
    });
    $('#type-create-customer-gift-marketing input:eq(0)').click();
    $('#phone-create-customer-gift-marketing').parents('.form-group').addClass('d-none');
    $('#name-create-customer-gift-marketing').parents('.form-group').addClass('d-none');
    $('#phone-create-customer-gift-marketing').val('');
    $('#phone-create-customer-gift-marketing').data('id', '');
    $('#name-create-customer-gift-marketing').text('');
    $('#modal-create-customer-gift-marketing select').find('option:first').prop('selected', true).trigger('change.select2');
}

