let checkSaveCreateSendMessageCampaign = 0, checkDataGiftCreateSendMessageCampaign = 0, dataIdCustomer = 0, thumbGiftCreate = '' ,dataCreateImageUploadCampaignMarketing;

$(function () {
    $('#upload-gift-banner').on('change', async function () {
        dataCreateImageUploadCampaignMarketing = $(this).prop('files')[0];
        switch((dataCreateImageUploadCampaignMarketing.type).slice(6)) {
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
        $('#thumbnail-gift-banner').css('object-fit', 'cover');
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        $('#thumbnail-gift-banner').attr('src', url_image);
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        thumbGiftCreate = data.data[0];
        $('#thumbnail-gift-banner').attr('data-src', data.data[0]);
        $(this).replaceWith($(this).val('').clone(true));
    });
    $('#select-type-create-send-message-campaign').on('select2:select', function () {
        $('.option-item-type-send-message-campaign').addClass('d-none');
        switch (Number($(this).val())){
            case 2:
                $('.option-item-type-send-message-campaign').addClass('d-none');
                break;
            case 1:
                $('#div-customer-create-send-message-campaign').removeClass('d-none');
                break;
            case 3:
                $('#time-last-used-create-send-message-campaign').removeClass('d-none');
                break;
            case 4:
                $('#box-select-gender-send-message-campaign').removeClass('d-none');
                break;
            case 5:
                $('#box-input-accumulate-send-message-campaign').removeClass('d-none');
                break;
            case 6:
                $('#box-select-level-send-message-campaign').removeClass('d-none');
                loadDataMemberShip();
                break;
        }

    })
    $('#select-type-gift-create-send-message-campaign').unbind('select2:select').on('select2:select', function () {
        loadDataGiftSendMessageCampaign();
        switch ($(this).val()) {
            case '1':
                $('#select-gift-create-send-message-campaign').parents('.form-group').removeClass('d-none');
                $('#url-gift-create-send-message-campaign').parents('.form-group').addClass('d-none');
                break;
            case '2':
                $('#select-gift-create-send-message-campaign').parents('.form-group').addClass('d-none');
                $('#url-gift-create-send-message-campaign').parents('.form-group').removeClass('d-none');
                break;
            default:
                $('#select-gift-create-send-message-campaign').parents('.form-group').addClass('d-none');
                $('#url-gift-create-send-message-campaign').parents('.form-group').addClass('d-none');
        }
    });
});
function openModalCreateSendMessageCampaign() {
    typeTabIndexCampaign = 0;
    updateCookie();
    $('#modal-create-send-message-campaign').modal('show');
    shortcut.remove("F2");
    shortcut.add('F4', function () {
        saveModalCreateSendMessageCampaign();
    });
    shortcut.add('ESC', function () {
        closeModalCreateSendMessageCampaign();
    });
    $('#modal-create-send-message-campaign .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-send-message-campaign')
    });
    $('#select-type-create-send-message-campaign').select2({
        dropdownParent: $('#modal-create-send-message-campaign'),
        templateResult : function (data, container){
            let span = '';
            if(data.disabled){
                span = $(`<span class="d-flex w-100 align-items-center justify-content-between"><span>${data.text}</span>
                        <span class="text-danger" style="font-weight: 500">Nhà hàng chưa kích hoạt thẻ thành viên</span></span>`);
            }else {
                span = $(`<span class="text-left">${data.text}</span>`);
            }
            return span;
        }
    });
    $('#modal-create-send-message-campaign input').on('input paste', function (){
        $('#modal-create-send-message-campaign .btn-renew').removeClass('d-none');
    });
    dateTimePickerMinDateToDayTemplate($('#time-create-send-message-campaign'));
    dateTimePickerHourMinuteTemplate($('#hour-create-send-message-campaign'));
    $('#hour-create-send-message-campaign').val(moment().add(1,"minutes").format("HH:mm"));
    //search theo số điện thoại
    $('#phone-create-send-message-campaign').on('keyup', function (e) {
        if ($(this).val() !== "") {
            $('#data-search-customer-send-message-campaign').removeClass('d-none');
            searchCustomerCreateSendMessageCampaign();
            if(e.keyCode == 13)
            {
                $('#phone-create-send-message-campaign').val($('.item-search-customer').first().attr('data-phone'));
                $('#data-search-customer-send-message-campaign').addClass('d-none')
                $('.name-search-customer').removeClass('d-none')
                $('.name-search-customer p').text('Tên KH: ' + $('.item-search-customer').first().find('h4').text())
                $('#name-search-customer').attr('data-id', $('.item-search-customer').first().attr('data-id'))
            }
        }else{
            $('#data-search-customer-send-message-campaign').addClass('d-none');
            $('.name-search-customer').addClass('d-none')
        }

        $('#loading-create-send-message-campaign').animate({scrollTop:$(document).height()}, 'slow');
    })

    $('#time-create-send-message-campaign,#hour-create-send-message-campaign').on('click', function (){
        $('#loading-create-send-message-campaign').scrollTop($('#loading-create-send-message-campaign').prop("scrollHeight"))
        $('#loading-create-send-message-campaign').css('scroll-behavior','smooth')
    })

    dateTimePickerNotWillMinDateTemplate($('#time-create-send-message-campaign'));
    dateTimePickerHourMinuteTemplate($('#hour-create-send-message-campaign'));
}


async function loadDataMemberShip () {
    let method = 'get',
        url = 'send-message-campaign.member-card',
        params = {},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-level-create-send-message-campaign')]);
    $('#select-level-create-send-message-campaign').html(res.data[0]);
    $('#select-level-update-send-message-campaign').html(res.data[0]);
}

/**
 * Customer
 */
let checkSearchCustomerCreateSendMessageCampaign = 0;

async function searchCustomerCreateSendMessageCampaign() {
    if (checkSearchCustomerCreateSendMessageCampaign === 1) return false;
    $('#customer-phone-create-booking-table-manage').data('id', 0);
    checkSearchCustomerCreateSendMessageCampaign = 1;

    let method = 'get',
        url = 'booking-table-manage.search-customer',
        phone = $('#phone-create-send-message-campaign').val(),
        params = {phone: phone, branch_id: -1},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    checkSearchCustomerCreateSendMessageCampaign = 0;
    let text = $('#success-status-data-to-server').text();
    switch (res.data[1].status){
        case 200:
            // $('#data-search-customer-send-message-campaign').removeClass('d-none');
            $('#data-search-customer-send-message-campaign').html(res.data[0]);
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
        let dataPhoneCustomer = $(this).attr('data-phone')
        let dataNameCustomer = $(this).find('.friend-meta h4').text()
        dataIdCustomer = $(this).attr('data-id')
        $('#phone-create-send-message-campaign').val(dataPhoneCustomer);
        $('#data-search-customer-send-message-campaign').addClass('d-none')
        if(dataPhoneCustomer){
            $('#data-search-customer-send-message-campaign').addClass('d-none')
            $('.name-search-customer').removeClass('d-none')
            $('.name-search-customer p').text('Tên KH: ' + dataNameCustomer)
            $('.name-search-customer p').attr('data-id', $(this).attr('data-id'))
        }
    })
}

async function saveModalCreateSendMessageCampaign() {
    if (checkSaveCreateSendMessageCampaign === 1) return false;
    if (!checkValidateSave($('#modal-create-send-message-campaign'))) return false;
    if($('#select-type-create-send-message-campaign').val() && $('.name-search-customer').hasClass('d-none') && !$('#div-customer-create-send-message-campaign').hasClass('d-none')){
        WarningNotify('Số điện thoại chưa đúng');
        $('#div-customer-create-send-message-campaign div').addClass('validate-error');
        return false;
    }
    if(!CKEDITOR.instances['content-create-send-message-campaign'].getData().length) {
        WarningNotify('Vui lòng nhập nội dung tin nhắn !');
        return false;
    }
    let title = $('#name-create-send-message-campaign').val(),
        content = CKEDITOR.instances['content-create-send-message-campaign'].getData(),
        type = $('#select-type-create-send-message-campaign').val(),
        time = $('#time-create-send-message-campaign').val() + ' ' + $('#hour-create-send-message-campaign').val(),
        branch_id = $('.select-brand').val(),
        customer_id = $('#name-search-customer').data('id'),
        customerGender = $('#select-gender-send-message-campaign').val(),
        customerAccPoint = $('#acc-points-create-send-message-campaign').val(),
        customerOffline = $('input[name="time-last-used-create-send-message-campaign"]:checked').val(),
        restaurantMembershipCardId = $('#select-level-create-send-message-campaign').val(),
        gift = 0,
        linkUrl = '';
        switch ($('#select-type-gift-create-send-message-campaign').val()) {
            case '1':
                gift = $('#select-gift-create-send-message-campaign').val();
                linkUrl = '';
                break;
            case '2':
                gift = 0;
                linkUrl = $.trim($('#url-gift-create-send-message-campaign').val());
                break;
            default:
                gift = 0;
                linkUrl = '';
                break;
        }

    checkSaveCreateSendMessageCampaign = 1;
    let method = 'post',
        url = 'send-message-campaign.create',
        params = null,
        data = {
            logo: thumbGiftCreate,
            link_url: linkUrl,
            title: title,
            content: content,
            type: type,
            id: type === '1' ? customer_id : 0,
            gender: type === '4' ? customerGender : 0,
            point: type === '5' ? customerAccPoint : 0,
            lastUsed: type === '3' ? customerOffline : 0,
            restaurantMembershipCardId: type === '6' ? restaurantMembershipCardId : 0,
            gift: gift,
            time: time,
            branch_id: branch_id,
        };
    let res = await axiosTemplate(method, url, params, data);
    checkSaveCreateSendMessageCampaign = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            addRowDatatableTemplate(tableWaitingAllowMessageCampaign,{
                'title' : res.data.data.data.title,
                'logo' : res.data.data.data.logo,
                'customer': res.data.data.data.customer,
                'send_notification_at': res.data.data.data.send_notification_at,
                'action': res.data.data.data.action,
                'keysearch': res.data.data.data.keysearch,
            })
            $('#total-record-waiting-allow').text(formatNumber(Number($('#total-record-waiting-allow').text()) + 1));
            closeModalCreateSendMessageCampaign();
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

function closeModalCreateSendMessageCampaign() {
    $('#modal-create-send-message-campaign').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateSendMessageCampaign();
    });
    reloadModalCreateSendMessageCampaign();
}

function reloadModalCreateSendMessageCampaign(){
    $('#select-gift-create-send-message-campaign').val($('#select-gift-create-send-message-campaign').find('option:first-child').val()).trigger('change.select2');
    $('#name-create-send-message-campaign').val('');
    $('#type-customer-create-send-message-campaign input[name="gender"][value="0"]').prop('checked', true);
    $('#type-time-create-send-message-campaign input[name="gender"][value="0"]').prop('checked', true);
    CKEDITOR.instances['content-create-send-message-campaign'].setData('');
    $('#modal-create-send-message-campaign .btn-renew').addClass('d-none');
    $('#name-create-send-message-campaign').val('');
    $('#content-create-send-message-campaign').val('');
    $('#type-customer-create-send-message-campaign input:eq(0)').prop('checked', true);
    $('#type-time-create-send-message-campaign input:eq(0)').prop('checked', true);
    $('#phone-create-send-message-campaign').val('');
    $('#phone-create-send-message-campaign').data('id', '');
    $('#customer-name-create-send-message-campaign').text('');
    $('#modal-create-send-message-campaign select').find('option:first').prop('selected', true).trigger('change.select2');
    $('#time-create-send-message-campaign').val(moment().format('DD/MM/YYYY'));
    $('#thumbnail-gift-banner').attr('src', '/images/tms/default.jpeg');
    $('#thumbnail-gift-banner').attr('data-src', '');
    // $('#phone-create-send-message-campaign').parent().addClass('disabled');
    // $('#phone-create-send-message-campaign').prop('disabled', true);
    $('#data-search-customer-send-message-campaign').addClass('d-none');
    $('#div-customer-create-send-message-campaign').addClass('d-none');
    // $('#time-create-send-message-campaign').prop('disabled', true);
    // $('#hour-create-send-message-campaign').prop('disabled', true);
    $('#select-type-gift-create-send-message-campaign').val(0).trigger('change.select2');
    $('#url-gift-create-send-message-campaign').val('');
    $('#select-gift-create-send-message-campaign').parents('.form-group').addClass('d-none');
    $('#url-gift-create-send-message-campaign').parents('.form-group').addClass('d-none');
    $('.option-item-type-send-message-campaign').addClass('d-none');
    $('#month-last-used-create-send-message-campaign').prop('checked', true);
    $('#acc-points-create-send-message-campaign').val('');
    $(this).css('object-fit', 'contain');
    $('#select-gender-send-message-campaign').val(0);
    $('#acc-points-create-send-message-campaign').val(0);
    $('#time-last-used-create-send-message-campaign').val(0);
    $('#select-level-create-send-message-campaign').val(0);
}
