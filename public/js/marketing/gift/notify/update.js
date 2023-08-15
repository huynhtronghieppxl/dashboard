let checkSaveUpdateNotifyGiftMarketing = 0, idUpdateNotifyGiftMarketing;

function openModalUpdateNotifyGiftMarketing(r) {
    $('#modal-update-notify-gift-marketing').modal('show');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalUpdateNotifyGiftMarketing();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateNotifyGiftMarketing();
    });

    $('#modal-update-notify-gift-marketing input').on('focus', function () {
        $(this).select();
    })

    $('#type-time-update-notify-gift-marketing input').on('click', function () {
        if ($(this).val() === '0') {
            $('#div-time-update-notify-gift-marketing').addClass('d-none');
        } else {
            $('#div-time-update-notify-gift-marketing').removeClass('d-none');
        }
    })

    $('#upload-logo-update-notify-gift-marketing').on('change', async function () {
        if ($(this).prop('files')[0].size > 5 * 1024 * 1024) {
            WarningNotify('Vui lòng chọn ảnh có kích thước dưới 5mb, ảnh hiện tại là ' + $(this).prop('files')[0].size + 'mb');
            return false;
        }
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        $('#thumbnail-logo-update-notify-gift-marketing').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        $('#thumbnail-logo-update-notify-gift-marketing').attr('data-src', data.data[0]);
        $(this).replaceWith($(this).val('').clone(true));
    })

    dateTimePickerNotWillMinDateTemplate($('#time-update-notify-gift-marketing'));
    dateTimePickerHourTemplate($('#hour-update-notify-gift-marketing'));
}


async function saveModalUpdateNotifyGiftMarketing() {
    if (checkSaveUpdateNotifyGiftMarketing === 1) return false;
    if (!checkValidateSave($('#modal-update-notify-gift-marketing'))) return false;
    let title = $('#name-update-notify-gift-marketing').val(),
        content = $('#content-update-notify-gift-marketing').val(),
        logo = $('#thumbnail-logo-update-notify-gift-marketing').data('src'),
        gift = $('#thumbnail-logo-update-notify-gift-marketing').data('src');
    let time = ($('#type-time-update-notify-gift-marketing input:checked').val() === '0') ? '' : $('#time-update-notify-gift-marketing').val() + ' ' + $('#hour-update-notify-gift-marketing').val();
    let method = 'post',
        url = 'notify-gift.update',
        params = null,
        data = {
            logo: logo,
            title: title,
            content: content,
            id: idUpdateNotifyGiftMarketing,
            time: time,
        };
    checkSaveUpdateNotifyGiftMarketing = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#loading-update-notify-gift-marketing")]);
    checkSaveUpdateNotifyGiftMarketing = 0;
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        loadData();
        closeModalUpdateNotifyGiftMarketing();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalUpdateNotifyGiftMarketing() {
    $('#modal-update-notify-gift-marketing').modal('hide');
    $('#name-update-notify-gift-marketing').val('');
    $('#content-update-notify-gift-marketing').val('');
    $('#time-update-notify-gift-marketing').val(moment().format('dd/mm/yyyy'));
    $('#thumbnail-logo-update-notify-gift-marketing').attr('src', '');
    $('#thumbnail-logo-update-notify-gift-marketing').attr('data-src', '');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateNotifyGiftMarketing();
    });
}
