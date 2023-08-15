let infoSaleSolutionSettingRestaurant,checkSaleSolutionSaveSettingRestaurant = 0, addressSaleSolutionSettingRestaurant,
    checkSaleSolutionSaveUpdateInfoRestaurant = 0,
    tabSaleSolutionRestaurantSetting = 0, emailSaleSolutionSettingRestaurant, domainSaleSolutionSettingRestaurant,
    nameSaleSolutionSettingRestaurant = 0,
    checkSaveUpdateBannerSaleSolutionRestaurant = 0,
    checkSaveUpdateSaleSolutionSettingRestaurant = 0, phoneSaleSolutionSettingRestaurant;
$(function () {
    if (getCookieShared('restaurant-sale-solution-setting-user-id-' +idSession)) {
        let data = JSON.parse(getCookieShared('restaurant-sale-solution-setting-user-id-' +idSession));
        tabSaleSolutionRestaurantSetting = data.tab;
    }

    dateTimePickerHourMinuteTemplate($('.input-datetimepicker'))
    dateTimePickerHourTemplate($('#hour-to-take-report-sale-solution'))

    $('#restaurant-sale-solution-general-configuration input:first').focus();

    $('#restaurant-sale-solution-general-configuration input').on('click', function () {
        $(this).select();
    })
    $(document).on('change','input[type="radio"][name="dayOfWeek"]',function () {
        if (Number(this.value) === -1) {
            $('#select-all-week-update-branch-sale-solution-setting').removeClass('d-none');
            $('#select-date-update-branch-sale-solution-setting').addClass('d-none');
        } else {
            $('#select-all-week-update-branch-sale-solution-setting').addClass('d-none');
            $('#select-date-update-branch-sale-solution-setting').removeClass('d-none');
        }
    });

    $('#wifi-free').on('change', function () {
        if ($(this).is(':checked')) {
            $('.wifi').removeClass('d-none')
        }else {
            $('.wifi').addClass('d-none')
        }
    })

    $('#username-prefix-sale-solution').on('input', function () {
        $(this).val(removeVietnameseString($(this).val().replace('_','')).toUpperCase());
    })

    $('#select-date-update-branch-sale-solution-setting .parent-node input[type=checkbox]').change(function () {
        if($('#select-date-update-branch-sale-solution-setting .parent-node input:checkbox:checked').length === 0 ){
            $('input[type="radio"][name="dayOfWeek"][value="-1"]').trigger('click')
            $(this).parents('.parent-node').children('div:last-child').addClass('d-none')
        }
        else if ($(this).is(':checked')) {
            $(this).parents('.parent-node').children('div:last-child').removeClass('d-none')
        } else {
            $(this).parents('.parent-node').children('div:last-child').addClass('d-none')
        }
    });
    $('#restaurant-sale-solution-general-configuration .nav-link[data-type="' + tabSaleSolutionRestaurantSetting + '"]').click();
    let element1 = $('#upload-restaurant-logo-sale-solution'), element2 = $('#upload-restaurant-banner-sale-solution'),
        view1 = $('#thumbnail-restaurant-logo-sale-solution'), view2 = $('#thumbnail-restaurant-banner-sale-solution'), type = 0; // kaizen
    uploadMediaCropTemplate(element1, view1, type, saveUpdateLogoRestaurant);
    uploadBannerCropTemplate(element2, view2, type, saveUpdateBannerRestaurant);
    loadData();
});

function updateCookieRestaurantSaleSolutionSetting() {
    saveCookieShared('restaurant-sale-solution-setting-user-id-' +idSession, JSON.stringify({
        'tab': tabSaleSolutionRestaurantSetting,
    }))
}

async function loadData() {
    let method = 'get',
        url = 'sale-solution-setting.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#restaurant-sale-solution-general-configuration")]);
    $('#username-prefix-sale-solution').val(res.data.data.username_prefix);
    $('#number-minute-allow-booking-sale-solution').val(res.data.data.number_minute_allow_booking_before_open_order);
    $('#hour-to-take-report-sale-solution').val(res.data.data.hour_to_take_report);
    $('#temporary-bill-sale-solution').prop('checked', res.data.data.is_allow_print_temporary_bill);
    $('#hidden-amount-sale-solution').prop('checked', res.data.data.is_hide_total_amount_before_complete_bill);
    $('#enable-booking-sale-solution').prop('checked', res.data.data.is_enable_booking);
    $('#logo-bill-sale-solution').prop('checked', res.data.data.is_print_bill_logo);
    $('#take-away-sale-solution').prop('checked', res.data.data.is_have_take_away);
    $('#print-lake-seafood-sale-solution').prop('checked', res.data.data.is_enable_fish_bowl);
    $('#stamp-sprint-sale-solution').prop('checked', res.data.data.is_enable_STAMP);
    $('#wifi-free').prop('checked', res.data.data.is_have_wifi);
    if(res.data.data.is_have_wifi){
        $('.wifi').removeClass('d-none')
        $('#wifi-name-sale-solution').val( res.data.data.wifi_name);
        $('#password-wifi-sale-solution').val(res.data.data.wifi_password);
    }else {
        $('.wifi').addClass('d-none')
    }
    if(res.data.data.serve_time.length == 0 || res.data.data.serve_time[0].day_of_week === -1){
        $('#form-radio-check-day-of-week-sale-solution input:eq(0)').prop('checked', true).trigger('change');
        $('#select-all-week-update-branch-sale-solution-setting').removeClass('d-none');
        $('#select-date-update-branch-sale-solution-setting').addClass('d-none');
    }else {
        $('#form-radio-check-day-of-week-sale-solution input:eq(1)').prop('checked', true).trigger('change');
        $('#select-all-week-update-branch-sale-solution-setting').addClass('d-none');
        $('#select-date-update-branch-sale-solution-setting').removeClass('d-none');

    }
    if (res.data.data.serve_time.length !== 0) {
        if (res.data.data.serve_time[0].day_of_week === -1) { // day_of_week = -1 -> Tất cả các ngày trong tuần
            $('#select-all-week-update-branch-sale-solution-setting .time-open-of-day').val(res.data.data.serve_time[0].open_time);
            $('#select-all-week-update-branch-sale-solution-setting .time-close-of-day').val(res.data.data.serve_time[0].close_time);
        } else {
            $('#select-date-update-branch-sale-solution-setting .time-open-of-day').val('00:00');
            $('#select-date-update-branch-sale-solution-setting .time-close-of-day').val('23:59');
            await $('#form-radio-check-day-of-week-sale-solution .radio-inline:eq(1) input').prop('checked', true).trigger('change');
            for(let i = 0; i<  res.data.data.serve_time.length; i++){
                $('#select-date-update-branch-sale-solution-setting .parent-node').find('input[type=checkbox][value='+res.data.data.serve_time[i].day_of_week+']').prop('checked',true);
                $('#select-date-update-branch-sale-solution-setting .parent-node').find('input[type=checkbox][value='+res.data.data.serve_time[i].day_of_week+']').parents('.parent-node').find('.time-open-of-day').val(res.data.data.serve_time[i].open_time);
                $('#select-date-update-branch-sale-solution-setting .parent-node').find('input[type=checkbox][value='+res.data.data.serve_time[i].day_of_week+']').parents('.parent-node').find('.time-close-of-day').val(res.data.data.serve_time[i].close_time);
                $('#select-date-update-branch-sale-solution-setting .parent-node').find('input[type=checkbox][value='+res.data.data.serve_time[i].day_of_week+']').parents('.parent-node').find('.time-open-of-day').prop('disabled',false);
                $('#select-date-update-branch-sale-solution-setting .parent-node').find('input[type=checkbox][value='+res.data.data.serve_time[i].day_of_week+']').parents('.parent-node').find('.time-close-of-day').prop('disabled',false);
            }
            $('#select-date-update-branch-sale-solution-setting .parent-node input[type=checkbox]').each(function (){
                if($(this).is(':checked')){
                    $(this).parents('.parent-node').children('div:last-child').removeClass('d-none')
                }
            })
        }
    }
    loadDataRestaurant();
}

async function loadDataRestaurant() {
    let method = 'get',
        url = 'sell-solution-res-setting.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#restaurant-sale-solution-general-configuration")]);
    $('#email-update-restaurant-sale-solution-setting').val(res.data[0].data.email);
    $('#phone-update-restaurant-sale-solution-setting').val(res.data[2].branch_info.phone);
    $('#name-update-restaurant-sale-solution-setting').val(res.data[0].data.name);
    $('#website-update-restaurant-sale-solution-setting').val(res.data[0].data.domain);
    $('#info-update-restaurant-sale-solution-setting').val(res.data[0].data.info);
    $('#restaurant-sale-solution-setting-name').text(res.data[0].data.name);
    $('#thumbnail-restaurant-logo-sale-solution').attr('src',res.data[0].logo);
    $('#thumbnail-restaurant-logo-sale-solution').attr('data-src',res.data[0].data.logo);
    $('#thumbnail-restaurant-banner-sale-solution').attr('src',res.data[0].banner);
    $('#thumbnail-restaurant-banner-sale-solution').attr('data-src',res.data[0].data.banner);
    $('#address-update-restaurant-sale-solution-setting').val(res.data[0].data.address)
    nameSaleSolutionSettingRestaurant = res.data[0].data.name;
    emailSaleSolutionSettingRestaurant = res.data[0].data.domain;
    phoneSaleSolutionSettingRestaurant= res.data[2].branch_info.phone;
    infoSaleSolutionSettingRestaurant = res.data[0].data.info;
    addressSaleSolutionSettingRestaurant = res.data[0].data.address;
    domainSaleSolutionSettingRestaurant = res.data[0].data.domain;
}
function checkTimeWorkingSaleSolution(){
    let flag = 1;
    if(Number($('#form-radio-check-day-of-week-sale-solution input[type="radio"]:checked').val()) == 0){
        $('#select-date-update-branch-sale-solution-setting input[type="checkbox"]').each(function(i,v) {
            if($(v).parents('.parent-node').find('.start-time-date-time-picker').val() == $(v).parents('.parent-node').find('.time-out-date-time-picker').val()){
                WarningNotify('Thời gian hoạt động không được giống nhau');
                $(v).parents('.parent-node').find('div.input-group').addClass('border-danger');
                flag = 0;
            }
        })
    }else{
        if($('.start-time-date-time-picker').val() == $('.time-out-date-time-picker').val()){
            $('#select-all-week-update-branch-sale-solution-setting div.input-group').addClass('border-danger')
            WarningNotify('Thời gian hoạt động không được giống nhau');
            flag = 0;
            return false;
        }
    }
    return flag;
}


async function saveUpdateLogoRestaurant(logo) {
    if (checkSaleSolutionSaveSettingRestaurant === 1) return false;
    checkSaleSolutionSaveSettingRestaurant = 1;
    let method = 'POST',
        url = 'sale-solution-setting.update',
        params = null,
        data = {
            name: nameSaleSolutionSettingRestaurant,
            email: emailSaleSolutionSettingRestaurant,
            info: infoSaleSolutionSettingRestaurant,
            domain: domainSaleSolutionSettingRestaurant,
            address: addressSaleSolutionSettingRestaurant,
            phone: phoneSaleSolutionSettingRestaurant,
            logo: $('#thumbnail-restaurant-logo-sale-solution').attr('data-src'),
            banner: $('#thumbnail-restaurant-banner-sale-solution').attr('data-src'),
        };
    let res = await axiosTemplate(method, url, params, data,[$("#thumbnail-restaurant-logo-sale-solution")]);
    checkSaleSolutionSaveSettingRestaurant = 0;
    let text = 'Cập nhật logo thành công';
    switch (res.data.status){
        case 200:
            $('#thumbnail-restaurant-logo-sale-solution').attr('src',  res.data.url_logo),
            $('#thumbnail-restaurant-logo-sale-solution').attr('data-src',  logo),
            SuccessNotify(text);
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

async function saveUpdateBannerRestaurant(banner) {
    if (checkSaveUpdateBannerSaleSolutionRestaurant === 1) return false;
    let method = 'POST',
        url = 'sale-solution-setting.update',
        params = null,
        data = {
            name: nameSaleSolutionSettingRestaurant,
            email: emailSaleSolutionSettingRestaurant,
            info: infoSaleSolutionSettingRestaurant,
            domain: domainSaleSolutionSettingRestaurant,
            address: addressSaleSolutionSettingRestaurant,
            phone: phoneSaleSolutionSettingRestaurant,
            logo: $('#thumbnail-restaurant-logo-sale-solution').attr('data-src'),
            banner: $('#thumbnail-restaurant-banner-sale-solution').attr('data-src'),
        };
    checkSaveUpdateBannerSaleSolutionRestaurant = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#thumbnail-restaurant-banner-sale-solution")]);
    checkSaveUpdateBannerSaleSolutionRestaurant = 0;
    let text = 'Cập nhật ảnh bìa thành công';
    switch (res.data.status){
        case 200:
            $('#thumbnail-restaurant-banner-sale-solution').attr('src', res.data.data.url_banner);
            $('#thumbnail-restaurant-banner-sale-solution').attr('data-src', banner);
            SuccessNotify(text);
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

async function saveUpdateInfoRestaurant() {
    if(checkSaleSolutionSaveUpdateInfoRestaurant === 1) return false;
    if (!checkValidateSave($('#restaurant-sale-solution-setting-tab-info')))
        return false;
    let method = 'post',
        url = 'sale-solution-setting.update',
        params = null,
        data = {
            name: $('#name-update-restaurant-sale-solution-setting').val(),
            email: $('#email-update-restaurant-sale-solution-setting').val(),
            info: $('#info-update-restaurant-sale-solution-setting').val(),
            domain: $('#website-update-restaurant-sale-solution-setting').val(),
            address: $('#address-update-restaurant-sale-solution-setting').val(),
            phone: $('#phone-update-restaurant-sale-solution-setting').val(),
            logo: $('#thumbnail-restaurant-logo-sale-solution').attr('data-src') == null ? '' : $('#thumbnail-restaurant-logo-sale-solution').attr('data-src'),
            banner: $('#thumbnail-restaurant-banner-sale-solution').attr('data-src') == null ? '' : $('#thumbnail-restaurant-banner-sale-solution').attr('data-src'),
        };
    checkSaleSolutionSaveUpdateInfoRestaurant = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#restaurant-sale-solution-general-configuration")]);
    checkSaleSolutionSaveUpdateInfoRestaurant = 0;
    let text = $('#success-update-data-to-server').text();
    switch (res.data.status){
        case 200:
            nameSaleSolutionSettingRestaurant = res.data.data.name;
            emailSaleSolutionSettingRestaurant = res.data.data.email;
            domainSaleSolutionSettingRestaurant = res.data.data.domain;
            infoSaleSolutionSettingRestaurant = res.data.data.info;
            addressSaleSolutionSettingRestaurant = res.data.data.address;
            phoneSaleSolutionSettingRestaurant = res.data.data.phone;
            SuccessNotify(text);
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

async function saveUpdateSettingRestaurant() {
    if(checkSaveUpdateSaleSolutionSettingRestaurant === 1) return false;
    if (!checkValidateSave($('#restaurant-sale-solution-setting-tab-setting'))){
        return false;
    }
    if(!checkTimeWorkingSaleSolution()) return false;
    let serve_time_arr = [];
    if ($('input[type=radio][name=dayOfWeek]:checked').val() == -1) {
        serve_time_arr.push({
            "day_of_week": -1,
            "open_time": $('#select-all-week-update-branch-sale-solution-setting').find('.time-open-of-day').val(),
            "close_time": $('#select-all-week-update-branch-sale-solution-setting').find('.time-close-of-day').val(),
        })
    } else {
        $("#select-date-update-branch-sale-solution-setting .parent-node").each(function () {
            if ($(this).find('input[type="checkbox"]').is(':checked')) {
                serve_time_arr.push({
                    "day_of_week": $(this).find('input[type="checkbox"]').val(),
                    "open_time": $(this).find('.time-open-of-day').val(),
                    "close_time": $(this).find('.time-close-of-day').val(),
                });
            }
        });
    }
    let method = 'post',
        url = 'sale-solution-setting.update-setting',
        params = null,
        data = {
            username_prefix : $('#username-prefix-sale-solution').val(),
            number_minute_allow_booking_before_open_order : removeformatNumber($('#number-minute-allow-booking-sale-solution').val()),
            hour_to_take_report : $('#hour-to-take-report-sale-solution').val(),
            is_allow_print_temporary_bill : Number($('#temporary-bill-sale-solution').is(':checked')),
            is_enable_booking : Number($('#enable-booking-sale-solution').is(':checked')),
            is_print_bill_logo : Number($('#logo-bill-sale-solution').is(':checked')),
            is_enable_STAMP : Number($('#stamp-sprint-sale-solution').is(':checked')),
            is_hide_total_amount_before_complete_bill : Number($('#hidden-amount-sale-solution').is(':checked')),
            is_enable_fish_bowl : Number($('#print-lake-seafood-sale-solution').is(':checked')),
            serve_time : serve_time_arr,
            is_have_wifi : Number($('#wifi-free').is(':checked')),
            wifi_name : $('#wifi-free').is(':checked') ? $('#wifi-name-sale-solution').val() : '',
            wifi_password : $('#wifi-free').is(':checked') ? $('#password-wifi-sale-solution').val() : '',
        };
    checkSaveUpdateSaleSolutionSettingRestaurant = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#restaurant-sale-solution-setting-tab-setting")]);
    checkSaveUpdateSaleSolutionSettingRestaurant = 0;
    let text = $('#success-update-data-to-server').text();
    switch (res.data.status){
        case 200:
            $('#btn-save-update-restaurant-setting').addClass('d-none');
            $('div.input-group').removeClass('border-danger');
            SuccessNotify(text);
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

function activeTab(r) {
    tabSaleSolutionRestaurantSetting = r.attr('data-type');
    updateCookieRestaurantSaleSolutionSetting();
    r.parents('ul').find('a').removeClass('active');
    r.addClass('active');
    switch (r.data('type')) {
        case 1:
            $('#btn-save-update-restaurant-setting').attr('onclick', 'saveUpdateSettingRestaurant()');
            break;
        default:
            $('#btn-save-update-restaurant-setting').attr('onclick', 'saveUpdateInfoRestaurant()');
            break;
    }
}

function CheckModifyValue(id, value) {
    if(id != value){
        $('#btn-save-update-restaurant-setting').removeClass('d-none')
    }
}

$(document).on('input','#restaurant-sale-solution-setting-tab-setting input',function () {
    CheckModifyValue($('#username-prefix').val(),$('#username-prefix').data('check'))
    CheckModifyValue($('#number-minute-allow-booking-before-open-order').val(),$('#number-minute-allow-booking-before-open-order').data('check'))
    CheckModifyValue($('#minute-after-register-member-ship-card-allow-to-use-promotion-point').val(),$('#minute-after-register-member-ship-card-allow-to-use-promotion-point').data('check'))
    CheckModifyValue($('#lat-brand').val(),$('#lat-brand').data('check'))
    CheckModifyValue(Number($('#is-share-customer-on-app-aloline').is(':checked')),$('#is-share-customer-on-app-aloline').data('check'))
})
$(document).on('change','#restaurant-sale-solution-setting-tab-setting input',function () {
    CheckModifyValue(Number($('#is-share-customer-on-app-aloline').is(':checked')),$('#is-share-customer-on-app-aloline').data('check'))
    CheckModifyValue(Number($('#is_enable_membership_card').is(':checked')),$('#is_enable_membership_card').data('check'))
    CheckModifyValue(Number($('#is-enable-kai-zen-bonus-level').is(':checked')),$('#is-enable-kai-zen-bonus-level').data('check'))
})
$(document).on('input','#restaurant-sale-solution-setting-tab-info input',function () {
    CheckModifyValue($('#name-update-restaurant-sale-solution-setting').val(),$('#name-update-restaurant-sale-solution-setting').data('check'))
    CheckModifyValue($('#email-update-restaurant-sale-solution-setting').val(),$('#email-update-restaurant-sale-solution-setting').data('check'))
    CheckModifyValue($('#website-update-restaurant-sale-solution-setting').val(),$('#website-update-restaurant-sale-solution-setting').data('check'))
})
$(document).on('input','#restaurant-sale-solution-setting-tab-info textarea',function () {
    CheckModifyValue($('#info-update-restaurant-sale-solution-setting').val(),$('#info-update-restaurant-sale-solution-setting').data('check'))
})

