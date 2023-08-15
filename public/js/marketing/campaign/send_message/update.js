let dataUpdateImageUploadSendMessage, thumbGiftUpdate = '', checkSaveUpdateSendMessageCampaign = 0, idUpdateSendMessageCampaign, checkSearchCustomerUpdateSendMessageCampaign =0;

$(function (){
    ckEditorTemplate(['content-update-send-message-campaign']);
    $('#upload-logo-update-send-message-campaign').on('change', async function () {
        dataUpdateImageUploadSendMessage = $(this).prop('files')[0];
        switch((dataUpdateImageUploadSendMessage.type).slice(6)) {
            case 'png':
                break;
            case 'jpeg':
                break;
            case 'jpg':
                break;
            case 'webp':
                break;
            default:
                WarningNotify('Bạn chỉ được chọn đuôi ảnh là JPEG, JPG, PNG, WEBP!');
                $(this).val('');
                return false;
        }
        if ($(this).prop('files')[0].size > 10 * 1024 * 1024) {
            WarningNotify('Bạn chỉ được tải lên ảnh có dung lượng nhỏ hơn 10MB!');
            $(this).val('');
            return false;
        }
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        $('#thumbnail-logo-update-send-message-campaign').css('object-fit', 'cover');
        $('#thumbnail-logo-update-send-message-campaign').attr('src', url_image);
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        thumbGiftUpdate = data.data[0];
        $(this).replaceWith($(this).val('').clone(true));
    });
    $('#select-type-gift-update-send-message-campaign').unbind('select2:select').on('select2:select', function () {
        switch ($(this).val()) {
            case '1':
                $('#select-gift-update-send-message-campaign').parents('.form-group').removeClass('d-none');
                $('#url-gift-update-send-message-campaign').parents('.form-group').addClass('d-none');
                break;
            case '2':
                $('#select-gift-update-send-message-campaign').parents('.form-group').addClass('d-none');
                $('#url-gift-update-send-message-campaign').parents('.form-group').removeClass('d-none');
                break;
            default:
                $('#select-gift-update-send-message-campaign').parents('.form-group').addClass('d-none');
                $('#url-gift-update-send-message-campaign').parents('.form-group').addClass('d-none');
        }
    });
    $('#select-type-update-send-message-campaign').on('select2:select', function () {
        $('.option-item-type-send-message-campaign').addClass('d-none');
        switch (Number($(this).val())){
            case 2:
                $('.option-item-type-send-message-campaign').addClass('d-none');
                break;
            case 1:
                $('#div-customer-update-send-message-campaign').removeClass('d-none');
                break;
            case 3:
                $('#time-last-used-update-send-message-campaign').removeClass('d-none');
                break;
            case 4:
                $('#box-select-update-gender-send-message-campaign').removeClass('d-none');
                break;
            case 5:
                $('#box-input-update-accumulate-send-message-campaign').removeClass('d-none');
                break;
            case 6:
                $('#box-select-update-level-send-message-campaign').removeClass('d-none');
                loadDataMemberShip();
                break;
        }
    });
    $('#phone-update-send-message-campaign').on('keyup', function (e) {
        if ($(this).val()) {
            $('#data-search-customer-update-send-message-campaign').removeClass('d-none');
            searchCustomerUpdateSendMessageCampaign();
            if(e.keyCode === 13)
            {
                $('#phone-create-send-message-campaign').val($('.item-search-customer').first().attr('data-phone'));
                $('#data-search-customer-send-message-campaign').addClass('d-none');
                $('.name-search-customer').removeClass('d-none');
                $('.name-search-customer p').text('Tên KH: ' + $('.item-search-customer').first().find('h4').text());
                $('#name-search-update-customer').attr('data-id', $('.item-search-customer').first().attr('data-id'));
            }
        }else{
            $('#data-search-customer-send-message-campaign').addClass('d-none');
            $('.name-search-customer').addClass('d-none');
        }

        $('#loading-create-send-message-campaign').animate({scrollTop:$(document).height()}, 'slow');
    });
});

function openModalUpdateSendMessageCampaign (r) {
    $('#modal-update-send-message-campaign').modal('show');
    shortcut.remove("F2");
    shortcut.add('F4', function () {
        saveModalUpdateSendMessageCampaign();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateSendMessageCampaign();
    });
    $('#modal-update-send-message-campaign .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-send-message-campaign')
    });
    idUpdateSendMessageCampaign = r.data('id');
    $('#modal-update-send-message-campaign input').on('focus', function () {
        $(this).select();
    })
    dateTimePickerMinDateToDayTemplate($('#time-update-send-message-campaign'));
    $('#time-update-send-message-campaign,#hour-update-send-message-campaign').on('click', function (){
        $('#loading-update-send-message-campaign').scrollTop($('#loading-update-send-message-campaign').prop("scrollHeight"))
    })
    $('#loading-update-send-message-campaign').css('scroll-behavior','smooth')
    dateTimePickerNotWillMinDateTemplate($('#time-update-send-message-campaign'));
    dateTimePickerHourMinuteTemplate($('#hour-update-send-message-campaign'));

    dataUpdate(r.data('id'));
}

async function dataUpdate(id) {
    let method = 'get',
        url = 'send-message-campaign.data-update',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#select-branch-update-send-message-campaign"),
        $("#thumbnail-gift-logo-update-send-message-campaign"),
        $("#value-food-update-send-message-campaign"),
        $("#table-food-update-send-message-campaign"),
    ]);
    $('#name-update-send-message-campaign').val(res.data.data.title);
    res.data.data.message_url ? $('#thumbnail-logo-update-send-message-campaign').css('object-fit', 'cover') : false;
    $('#thumbnail-logo-update-send-message-campaign').attr('src', res.data.data.message_url ? res.data.data.message_url_media : '/images/tms/default.jpeg');
    $('#select-type-update-send-message-campaign').val(res.data.data.customer_marketing_notification_type).trigger('change.select2');
    $('.option-item-type-send-message-campaign').addClass('d-none');
    switch (res.data.data.customer_marketing_notification_type) {
        case 1:
            $('#div-customer-update-send-message-campaign').removeClass('d-none');
            $('.name-search-customer-update').removeClass('d-none');
            $('#phone-update-send-message-campaign').val(res.data.data.customer.phone);
            $('#name-search-update-customer').text('Tên KH: ' + res.data.data.customer.name);
            $('#name-search-update-customer').attr('data-id'  + res.data.data.customer.id);
            break;
        case 3:
            $('#time-last-used-update-send-message-campaign').removeClass('d-none');
            $('input[name="time-last-used-create-send-message-campaign"][value="'+ res.data.data.period_customer_offline +'"]');
            break;
        case 4:
            $('#box-select-update-gender-send-message-campaign').removeClass('d-none');
            $('#select-gender-update-send-message-campaign').val(res.data.data.customer_gender).trigger('change.select2');
            break;
        case 5:
            $('#box-input-update-accumulate-send-message-campaign').removeClass('d-none');
            $('#box-input-update-accumulate-send-message-campaign').val(res.data.data.customer_gender);
            break;
        case 6:
            $('#box-select-update-level-send-message-campaign').removeClass('d-none');
            $('#select-level-update-send-message-campaign').val(res.data.data.restaurant_membership_card_id).trigger('change.select2');
            break;
    }
    $('#time-update-send-message-campaign').val(moment().format((res.data.data.send_notification_at).slice(0,11)));
    $('#hour-update-send-message-campaign').val(moment().format((res.data.data.send_notification_at).slice(11,16)));
    if(res.data.data.restaurant_gift_id) {
        $('#select-type-gift-update-send-message-campaign').val(1).trigger('change.select2');
        $('#select-gift-update-send-message-campaign').parents('.form-group').removeClass('d-none');
        $('#select-gift-update-send-message-campaign').val(res.data.data.restaurant_gift_id).trigger('change.select2');
    }
    if(res.data.data?.link_url) {
        $('#select-type-gift-update-send-message-campaign').val(2).trigger('change.select2');
        $('#url-gift-update-send-message-campaign').parents('.form-group').removeClass('d-none');
        $('#url-gift-update-send-message-campaign').val(res.data.data?.link_url).trigger('change.select2');
    }
    CKEDITOR.instances['content-update-send-message-campaign'].setData(res.data.data.content);
    if(res.data.data.customer_marketing_notification_type === 1){
            $('#type-time-update-send-message-campaign').addClass('checked',true);
    }
}

async function searchCustomerUpdateSendMessageCampaign() {
    if (checkSearchCustomerUpdateSendMessageCampaign === 1) return false;
    $('#customer-phone-update-booking-table-manage').data('id', 0);
    checkSearchCustomerUpdateSendMessageCampaign = 1;

    let method = 'get',
        url = 'booking-table-manage.search-customer',
        phone = $('#phone-update-send-message-campaign').val(),
        params = {phone: phone, branch_id: -1},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    checkSearchCustomerUpdateSendMessageCampaign = 0;
    let text = $('#success-status-data-to-server').text();
    switch (res.data[1].status){
        case 200:
            // $('#data-search-customer-send-message-campaign').removeClass('d-none');
            $('#data-search-customer-update-send-message-campaign').html(res.data[0]);
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            WarningNotify(text);
    }

    $('.item-search-customer').on('click', function (){
        let dataPhoneCustomer = $(this).attr('data-phone');
        let dataNameCustomer = $(this).find('.friend-meta h4').text();
        $('#phone-update-send-message-campaign').val(dataPhoneCustomer);
        $('#data-search-customer-update-send-message-campaign').addClass('d-none');
        if(dataPhoneCustomer){
            $('#data-search-customer-update-send-message-campaign').addClass('d-none');
            $('.name-search-customer-update').removeClass('d-none');
            $('#name-search-update-customer').text('Tên KH: ' + dataNameCustomer);
            $('#name-search-update-customer').attr('data-id', $(this).attr('data-id'));
        }
    })
}
async function saveModalUpdateSendMessageCampaign() {
    if (checkSaveUpdateSendMessageCampaign === 1) return false;
    console.log(checkValidateSave($('#modal-update-send-message-campaign')))
    if (!checkValidateSave($('#modal-update-send-message-campaign'))) return false;
    if(!CKEDITOR.instances['content-update-send-message-campaign'].getData().length) {
        WarningNotify('Vui lòng nhập nội dung tin nhắn !');
        return false;
    }
    let title = $('#name-update-send-message-campaign').val(),
        content = CKEDITOR.instances['content-update-send-message-campaign'].getData(),
        type = $('#select-type-update-send-message-campaign').val(),
        brand_id = $('.select-brand').val(),
        customer_id = $('#name-search-update-customer').data('id'),
        customerGender = $('#select-gender-update-send-message-campaign').val(),
        customerAccPoint = $('#acc-points-update-send-message-campaign').val(),
        customerOffline = $('input[name="time-last-used-update-send-message-campaign"]:checked').val(),
        restaurantMembershipCardId = $('#select-level-update-send-message-campaign').val(),
        gift = 0,
        linkUrl = '';
    switch ($('#select-type-gift-update-send-message-campaign').val()) {
        case '1':
            gift = $('#select-gift-update-send-message-campaign').val();
            linkUrl = '';
            break;
        case '2':
            gift = 0;
            linkUrl = $.trim($('#url-gift-update-send-message-campaign').val());
            break;
        default:
            gift = 0;
            linkUrl = '';
            break;
    }
    let time = $('#time-update-send-message-campaign').val() + ' ' + $('#hour-update-send-message-campaign').val();
    checkSaveUpdateSendMessageCampaign = 1;
    let method = 'post',
        url = 'send-message-campaign.update',
        params = null,
        data = {
            logo: thumbGiftUpdate,
            title: title,
            link_url: linkUrl,
            gift: gift,
            content: content,
            type: type,
            id: idUpdateSendMessageCampaign,
            customer_id: type === '1' ? customer_id : 0,
            gender: type === '4' ? customerGender : 0,
            point: type === '5' ? customerAccPoint : 0,
            lastUsed: type === '3' ? customerOffline : 0,
            restaurantMembershipCardId: type === '6' ? restaurantMembershipCardId : 0,
            time: time,
            brand_id : brand_id
        };
    let res = await axiosTemplate(method, url, params, data,[$("#loading-update-send-message-campaign")]);
    checkSaveUpdateSendMessageCampaign = 0;
    let text = $('#success-update-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            loadDataSendMessage();
            closeModalUpdateSendMessageCampaign();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            WarningNotify(text);
    }
}


function closeModalUpdateSendMessageCampaign() {
    $('#modal-update-send-message-campaign').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateSendMessageCampaign();
    });
    reloadModalUpdateSendMessageCampaign();
}

function reloadModalUpdateSendMessageCampaign(){
    $('#name-update-send-message-campaign').val('');
    CKEDITOR.instances['content-update-send-message-campaign'].setData('');
    $('#time-update-send-message-campaign').val(moment().format('DD/MM/yyyy'));
    $('#hour-update-send-message-campaign').val(moment().format('HH:mm'));
    $('#thumbnail-logo-update-send-message-campaign').attr('src', '');
    $('#select-type-gift-update-send-message-campaign').val(0).trigger('change.select2');
    $('#url-gift-update-send-message-campaign').val('');
    $('#select-gift-update-send-message-campaign').parents('.form-group').addClass('d-none');
    $('#url-gift-update-send-message-campaign').parents('.form-group').addClass('d-none');
    $('.option-item-type-send-message-campaign').addClass('d-none');
    $('#select-type-update-send-message-campaign').val(2).trigger('change.select2');
    $('#thumbnail-logo-update-send-message-campaign').css('object-fit', 'contain');
    $('#select-gender-update-send-message-campaign').val(0);
    $('#acc-points-update-send-message-campaign').val(0);
    $('#time-last-used-update-send-message-campaign').val(0);
    $('#select-level-update-send-message-campaign').val(0);

}
