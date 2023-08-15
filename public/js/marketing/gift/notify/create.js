let checkSaveCreateNotifyGiftMarketing = 0, checkDataGiftCreateNotifyGiftMarketing = 0;

function openModalCreateNotifyGiftMarketing() {
    $('#modal-create-notify-gift-marketing').modal('show');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalCreateNotifyGiftMarketing();
    });
    shortcut.add('ESC', function () {
        closeModalCreateNotifyGiftMarketing();
    });
    $('#modal-create-notify-gift-marketing .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-notify-gift-marketing')
    });

    $('#type-create-notify-gift-marketing').on('select2:select', function () {
        if ($(this).val() === '2') {
            $('#phone-create-notify-gift-marketing').parents('.form-group').addClass('d-none');
            $('#customer-name-create-notify-gift-marketing').parents('.form-group').addClass('d-none');
        } else {
            $('#phone-create-notify-gift-marketing').parents('.form-group').removeClass('d-none');
            $('#customer-name-create-notify-gift-marketing').parents('.form-group').removeClass('d-none');
        }
    })

    $('#type-time-create-notify-gift-marketing input').on('click', function () {
        if ($(this).val() === '0') {
            $('#div-time-create-notify-gift-marketing').addClass('d-none');
        } else {
            $('#div-time-create-notify-gift-marketing').removeClass('d-none');
        }
    })

    $('#phone-create-notify-gift-marketing').unbind('input paste').on('input paste', function () {
        if ($('#phone-create-notify-gift-marketing').val().length >= 10 && $('#phone-create-notify-gift-marketing').val().substring(0, 2).match(/^(09|03|07|08|05).*$/)) {
            searchCustomerCreateNotifyGiftMarketing();
        }
    });

    $('#modal-create-notify-gift-marketing input').on('focus', function () {
        $(this).select();
    })

    $('#upload-gift-banner').on('change', async function () {
        if ($(this).prop('files')[0].size > 5 * 1024 * 1024) {
            WarningNotify('Vui lòng chọn ảnh có kích thước dưới 5mb, ảnh hiện tại là ' + $(this).prop('files')[0].size + 'mb');
            return false;
        }
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        $('#thumbnail-gift-banner').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        $('#thumbnail-gift-banner').attr('data-src', data.data[0]);
        $(this).replaceWith($(this).val('').clone(true));
    })

    dateTimePickerNotWillMinDateTemplate($('#time-create-notify-gift-marketing'));
    dateTimePickerHourTemplate($('#hour-create-notify-gift-marketing'));
    loadDataGiftCreateNotifyGiftMarketing();
}

async function loadDataGiftCreateNotifyGiftMarketing() {
    if (checkDataGiftCreateNotifyGiftMarketing === 0) {
        let brand = $('#restaurant-branch-id-selected span').attr('data-value');
        let method = 'get',
            url = 'notify-gift.gift',
            params = {
                brand: brand,
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data,[$("#select-gift-create-notify-gift-marketing")]);
        checkDataGiftCreateNotifyGiftMarketing = 1;
        $('#select-gift-create-notify-gift-marketing').html(res.data[0]);
    }
}

async function searchCustomerCreateNotifyGiftMarketing() {
    let method = 'GET',
        url = 'notify-gift.customer',
        params = {phone: $('#phone-create-notify-gift-marketing').val()},
        data = null ;
    let res = await axiosTemplate(method, url, params, data);
    if (res.data.status === 200) {
        $('#customer-name-create-notify-gift-marketing').text(res.data.data.name);
        $('#phone-create-notify-gift-marketing').data('id', res.data.data.id);
    } else {
        $('#customer-name-create-notify-gift-marketing').text('');
        $('#phone-create-notify-gift-marketing').data('id', '0');
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

async function saveModalCreateNotifyGiftMarketing() {
    if (checkSaveCreateNotifyGiftMarketing === 1) return false;
    if (!checkValidateSave($('#modal-create-notify-gift-marketing'))) return false;
    let title = $('#name-create-notify-gift-marketing').val(),
        content = $('#content-create-notify-gift-marketing').val(),
        type = $('#type-create-notify-gift-marketing').val(),
        id = ($('#phone-create-notify-gift-marketing').data('id') === null) ? 0 : $('#phone-create-notify-gift-marketing').data('id') ,
        gift = $('#select-gift-create-notify-gift-marketing').val(),
        logo = $('#thumbnail-gift-banner').data('src');
    let time = ($('#type-time-create-notify-gift-marketing input:checked').val() === '0') ? '' : $('#time-create-notify-gift-marketing').val() + ' ' + $('#hour-create-notify-gift-marketing').val();
    let method = 'post',
        url = 'notify-gift.create',
        params = null,
        data = {
            logo: logo,
            title: title,
            content: content,
            type: type,
            id: id,
            gift: gift,
            time: time,
        };
    checkSaveCreateNotifyGiftMarketing = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#loading-create-notify-gift-marketing")]);
    checkSaveCreateNotifyGiftMarketing = 0;
    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        loadData();
        closeModalCreateNotifyGiftMarketing();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalCreateNotifyGiftMarketing() {
    $('#modal-create-notify-gift-marketing').modal('hide');
    $('#name-create-notify-gift-marketing').val('');
    // CKEDITOR.instances['content-create-notify-gift-marketing'].setData('');
    $('#content-create-notify-gift-marketing').val('');
    $('#type-time-create-notify-gift-marketing input:eq(0)').prop('checked', true);
    $('#div-time-create-notify-gift-marketing').addClass('d-none');
    $('#phone-create-notify-gift-marketing').val('');
    $('#phone-create-notify-gift-marketing').data('id', '');
    $('#customer-name-create-notify-gift-marketing').text('');
    $('#modal-create-notify-gift-marketing select').find('option:first').prop('selected', true).trigger('change.select2');
    $('#time-create-notify-gift-marketing').val(moment().format('dd/mm/yyyy'));
    $('#thumbnail-gift-banner').attr('src', '../images/techres_logo.jpg');
    $('#thumbnail-gift-banner').attr('data-src', '');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateNotifyGiftMarketing();
    });
}
