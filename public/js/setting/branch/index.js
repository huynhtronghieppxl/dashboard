let branchSettingId, branchStatusSettingBranch,  oldUrlBannerSettingBranch, oldUrlLogoSettingBranch,
    oldUrlImageSettingBranch = [], restaurantImgListSettingBranch = [], listImageSettingBranch = [],
    qrCodeCheckInBranchSetting, latSettingBranch = 106.6913599, lngSettingBranch = 10.8201478 , oldBranchIdSettingBranch, thisBranchSetting, nameBranchSetting, checkSaveUpdateBranchSetting = 0,
    tabIndexBranchSetting = 0,tabSettingBranchSetting = 0, tabTypeBranchSetting = 0, timer , waitTime = 500, markerMap4D, map4D;
$(function () {
    if (getCookieShared('branch-setting-user-id-' + idSession)) {
        let data = JSON.parse(getCookieShared('branch-setting-user-id-' + idSession));
        tabIndexBranchSetting = data.tab;
        tabSettingBranchSetting = data.type;
        tabTypeBranchSetting = data.typeSetting;
    }
    dataProfileBranch();
    loadData();
    uploadMediaCropTemplate($('#upload-branch-logo'), $('#thumbnail-branch-logo'), 3, updateLogoBranchSetting);
    uploadBannerCropTemplate($('#upload-branch-banner'), $('#thumbnail-branch-banner'), 3, updateBannerBranchSetting);
    $('.btn-move-image').on('click', function (e) {
        e.stopPropagation();
        return false;
    });
    $('#link-url-web, #link-url-facebook').bind('click', function(e) {
        window.open($(this).attr("href"));
        e.preventDefault();
    });

    shortcut.add("F4",function() {
        updateInfoBranchSetting();
    })

    // Chặn click ngoài checkbox
    $('.name-checkbox').on('mouseenter', function() {
        let tooltip = $(this).find('.tool-tip');
        let checkbox = $(this).find('input[type="checkbox"]');
        tooltip.tooltip('show');
        tooltip.on('mousedown', function(event) {
            event.preventDefault();
            event.stopPropagation();
        });
        checkbox.on('mousedown', function(event) {
            event.stopPropagation();
        });
        checkbox.on('mouseup', function(event){
            if ($(this).is(':checked')) {
                $(this).click();
            }
        });
    });

    $(document).on('change','input[type="radio"][name="dayOfWeek"]',function () {
        if (Number(this.value) === -1) {
            $('#select-all-week-update-branch-setting').removeClass('d-none');
            $('#select-date-update-branch-setting').addClass('d-none');
        } else {
            $('#select-all-week-update-branch-setting').addClass('d-none');
            $('#select-date-update-branch-setting').removeClass('d-none');
        }
    });

    $('#select-date-update-branch-setting .parent-node input[type=checkbox]').change(function () {
        if($('#select-date-update-branch-setting .parent-node input:checkbox:checked').length === 0 ){
            $('input[type="radio"][name="dayOfWeek"][value="-1"]').trigger('click')
            $(this).parents('.parent-node').children('div:last-child').addClass('d-none')
        }
        else if ($(this).is(':checked')) {
            $(this).parents('.parent-node').children('div:last-child').removeClass('d-none')
        } else {
            $(this).parents('.parent-node').children('div:last-child').addClass('d-none')
        }
    });

    $(document).on('input','.start-time-date-time-picker',function () {
        if($(this).val() == ''){
            $(this).val('00:00')
        }
    })
    $(document).on('input','.time-out-date-time-picker',function () {
        if($(this).val() == ''){
            $(this).val('23:59')
        }
    })

    $(document).on("change", "#is-wifi-edit", function () {
        if ($(this).is(':checked')) {
            $('#wifi-name-update-branch-setting').val('');
            $('#wifi-password-update-branch-setting').val('');
            $('#display-if-have-wifi').removeClass('d-none');
            $('#display-if-have-password').removeClass('d-none');
        } else {
            $('#display-if-have-wifi').addClass('d-none');
            $('#display-if-have-password').addClass('d-none');
        }
    });
})
function updateCookie() {
    saveCookieShared('branch-setting-user-id-' + idSession, JSON.stringify({
        'tab': tabIndexBranchSetting,
        'type' : tabSettingBranchSetting,
        'typeSetting' : tabTypeBranchSetting
    }))
}


async function loadData() {
    let restaurant_brand_id = $('#restaurant-branch-id-selected span').data('value');
    let method = 'get',
        url = 'branch-setting.data',
        params = {restaurant_brand_id: restaurant_brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#list-branch-setting').html(res.data[0]);
    if (res.data[1] > 1) {
        $('.branch-setting-detail').on('click', function () {
            $('#div-branch-setting').removeClass('d-none')
            $('#list-branch-setting').addClass('d-none')
            $('#btn-back-list-branch').removeClass('d-none')
            $('#btn-update-info-branch-setting').removeClass('d-none')
        })
        $('#btn-back-list-branch').on('click', function () {
            tabTypeBranchSetting = 0;
            updateCookie();
            removeAllValidate();
            if ($('#div-media-setting-branch').hasClass('d-none') === true) {
                $('#div-branch-setting').addClass('d-none')
                $('.branch-online').addClass('d-none')
                $('#btn-back-list-branch').addClass('d-none')
                $('#list-branch-setting').removeClass('d-none')
                $('#btn-update-info-branch-setting').addClass('d-none')
            } else {
                setupPaginationFolder(lengthFolderBranch);
                $('#div-media-setting-branch').addClass('d-none');
                $('#div-folder-setting-branch').removeClass('d-none');
            }
        })
    } else {
        nameBranchSetting = res.data[2].data[0].name;
        branchSettingId = res.data[2].data[0].id;
        $('#thumbnail-branch-logo').attr('src', res.data[2].data[0].image_logo);
        $('#thumbnail-branch-banner').attr('src', res.data[2].data[0].banner);
        $('#branch-detail-setting-name').text(res.data[2].data[0].name);
        $('#list-branch-setting').addClass('d-none');
        $('#btn-back-list-branch').addClass('d-none');
        $('#div-branch-setting').removeClass('d-none');
        $('#btn-update-info-branch-setting').removeClass('d-none');
        dataUpdateBranchSetting(res.data[2].data[0].id)
        dataServeBranchSetting(res.data[2].data[0].id);
        qrCodeCheckInBranchSetting = res.data[2].data[0]['qr_code_checkin'];
    }
    $('#div-branch-setting input').on('click', function () {
        $(this).select();
    })
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
    if (tabTypeBranchSetting === 1){
        $('#list-branch-setting li .branch-setting-detail[data-type="' + tabIndexBranchSetting + '"]').click();
        $('.nav-link[data-status="' + tabSettingBranchSetting + '"]').click();
    }
    $('#div-branch-setting .nav-link').on('click',function (){
        tabSettingBranchSetting = $(this).attr('data-status');
        updateCookie();
    })
}

async function dataProfileBranch(r) {
    tabTypeBranchSetting = 1;
    tabIndexBranchSetting = r?.attr('data-type');
    updateCookie();
    $('.profile-controls li a').removeClass('active')
    $('.profile-controls li a').eq(1).click();
    if (oldBranchIdSettingBranch !== r?.data('id')) {
        thisBranchSetting = r;
        branchSettingId = r?.data('id');
        nameBranchSetting = r?.data('name');
        qrCodeCheckInBranchSetting = r?.data('code-check-in');
        $('#thumbnail-branch-logo').attr('src', r?.data('logo'));
        $('#thumbnail-branch-banner').attr('src', r?.data('banner'));
        $('#branch-detail-setting-name').text(r?.data('name'));
        $('#name-update-branch-setting').val(r?.data('name'));
        dataUpdateBranchSetting(r?.data('id'));
        dataServeBranchSetting(r?.data('id'));
        drawGallery();
    }
}


async function dataUpdateBranchSetting(id) {
    let method = 'get',
        url = 'branch-setting.data-profile',
        params = {id: id},
        data = '';
    let res = await axiosTemplate(method, url, params, data,[
        $("#select-city-update-branch-setting"),
        $("#select-district-update-branch-setting"),
        $("#select-ward-update-branch-setting"),
        $('#branch-setting-tab-1')
    ]);
    oldUrlBannerSettingBranch = res.data[0].banner;
    oldUrlLogoSettingBranch = res.data[0].image_logo;
    branchStatusSettingBranch = res.data[0].status;
    oldUrlImageSettingBranch = res.data[0].image_urls;
    listImageSettingBranch = res.data[0].image_urls;
    $('#review-branch-image-url #image-branch').html('');
    $('#name-update-branch-setting').val(res.data[0].name);
    $('#name-update-branch-setting').data('id', res.data[0].id);
    $('#phone-update-branch-setting').val(res.data[0].phone);
    $('#branch-avg-amount-customer-update-branch-setting').val(formatNumber(res.data[0].average_amount_per_customer));
    $('#full-address-update-branch-setting').val(res.data[0].address);
    $('#note-address-update-branch-setting').val(res.data[0].address_note);
    $('#address-update-branch-setting').val(res.data[0].street_name);
    $('#select-city-update-branch-setting').html(res.data[0].select_city);
    $('#select-district-update-branch-setting').html(res.data[0].select_district);
    $('#select-ward-update-branch-setting').html(res.data[0].select_ward);
    $('#website-update-branch-setting').val(res.data[0].website);
    $('#facebook-update-branch-setting').val(res.data[0].facebook);
    $('#wifi-name-update-branch-setting').val(res.data[0].wifi_name);
    $('#wifi-password-update-branch-setting').val(res.data[0].wifi_password);
    $('#select-city-update-branch-setting').val(res.data[0].city_id).trigger('change.select2');
    $('#select-district-update-branch-setting').val(res.data[0].district_id).trigger('change.select2');
    $('#select-ward-update-branch-setting').val(res.data[0].ward_id).trigger('change.select2');
    latSettingBranch = res.data[0].lat;
    lngSettingBranch = res.data[0].lng;
    if (res.data[0].serve_time.length !== 0) {
        if (res.data[0].serve_time[0].day_of_week === -1) { // day_of_week = -1 -> Tất cả các ngày trong tuần
            $('#select-all-week-update-branch-setting .time-open-of-day').val(res.data[0].serve_time[0].open_time);
            $('#select-all-week-update-branch-setting .time-close-of-day').val(res.data[0].serve_time[0].close_time);
        } else {
            $('#select-date-update-branch-setting .time-open-of-day').val('00:00');
            $('#select-date-update-branch-setting .time-close-of-day').val('23:59');
            await $('#form-radio-check-day-of-week .radio-inline:eq(1) input').prop('checked', true).trigger('change');
            for(let i = 0; i<  res.data[0].serve_time.length; i++){
                $('#select-date-update-branch-setting .parent-node').find('input[type=checkbox][value='+res.data[0].serve_time[i].day_of_week+']').prop('checked',true);
                $('#select-date-update-branch-setting .parent-node').find('input[type=checkbox][value='+res.data[0].serve_time[i].day_of_week+']').parents('.parent-node').find('.time-open-of-day').val(res.data[0].serve_time[i].open_time);
                $('#select-date-update-branch-setting .parent-node').find('input[type=checkbox][value='+res.data[0].serve_time[i].day_of_week+']').parents('.parent-node').find('.time-close-of-day').val(res.data[0].serve_time[i].close_time);
                $('#select-date-update-branch-setting .parent-node').find('input[type=checkbox][value='+res.data[0].serve_time[i].day_of_week+']').parents('.parent-node').find('.time-open-of-day').prop('disabled',false);
                $('#select-date-update-branch-setting .parent-node').find('input[type=checkbox][value='+res.data[0].serve_time[i].day_of_week+']').parents('.parent-node').find('.time-close-of-day').prop('disabled',false);
            }
            $('#select-date-update-branch-setting .parent-node input[type=checkbox]').each(function (){
                if($(this).is(':checked')){
                    $(this).parents('.parent-node').children('div:last-child').removeClass('d-none')
                }
            })
        }
    }
    if (res.data[3] !== []) {
        $('.list-images-branch-setting').html(res.data[3]);
    }
    dateTimePickerHourMinuteTemplate($('.start-time-date-time-picker'));
    dateTimePickerHourMinuteTemplate($('.time-out-date-time-picker'));
    if (res.data[0].is_have_wifi === 1) {
        $('#display-if-have-wifi').removeClass('d-none');
        $('#display-if-have-password').removeClass('d-none');
    } else {
        $('#display-if-have-wifi').addClass('d-none');
        $('#display-if-have-password').addClass('d-none');
    }

    if(res.data[0].serve_time[0].day_of_week === -1){
        $('#form-radio-check-day-of-week input:eq(0)').prop('checked', true).trigger('change');
        $('#select-all-week-update-branch-setting').removeClass('d-none');
        $('#select-date-update-branch-setting').addClass('d-none');

    }else {
        $('#form-radio-check-day-of-week input:eq(1)').prop('checked', true).trigger('change');
        $('#select-all-week-update-branch-setting').addClass('d-none');
        $('#select-date-update-branch-setting').removeClass('d-none');
    }

    $('#is-wifi-edit').prop('checked', res.data[0].is_have_wifi);
    $('#is-air-conditioner-edit').prop('checked', res.data[0].is_have_air_conditioner);
    $('#is-parking-edit').prop('checked', res.data[0].is_free_parking);
    $('#is-booking-online-edit').prop('checked', res.data[0].is_have_booking_online);
    $('#is-car-parking-edit').prop('checked', res.data[0].is_have_car_parking);
    $('#is-card-payment-edit').prop('checked', res.data[0].is_have_card_payment);
    $('#is-child-corner-edit').prop('checked', res.data[0].is_have_child_corner);
    $('#is-invoice-edit').prop('checked', res.data[0].is_have_invoice);
    $('#is-karaoke-edit').prop('checked', res.data[0].is_have_karaoke);
    $('#is-live-music-edit').prop('checked', res.data[0].is_have_live_music);
    $('#is-order-food-online-edit').prop('checked', res.data[0].is_have_order_food_online);
    $('#is-outdoor-edit').prop('checked', res.data[0].is_have_outdoor);
    $('#is-private-room-edit').prop('checked', res.data[0].is_have_private_room);
    $('#is-shipping-edit').prop('checked', res.data[0].is_have_shipping);
    $('#is-use-finger-print-edit').prop('checked', res.data[0].is_use_fingerprint);

    $('#select-city-update-branch-setting').on('change', function () {
        dataDistrictUpdateBranchSetting();
    });

    $('#select-district-update-branch-setting').on('change', function () {
        dataWardUpdateBranchSetting();
    });

    initMap();
}

async function dataServeBranchSetting(id) {
    let method = 'get',
        url = 'branch-setting.serve',
        params = {branch: id},
        data = {};
    let res = await axiosTemplate(method, url, params, data,[$("#branch-setting-tab-1")]);
    $('#is-offline-branch').prop('checked', res.data.data.is_working_offline)
    $('#is-enable-booking-branch').prop('checked', res.data.data.is_enable_booking)
    $('#led-adv').prop('checked', res.data.data.is_allow_advert);
    $('#is-enable-fish-bowl').prop('checked', res.data.data.is_enable_fish_bowl);
    $('#is-enable-print-stamp').prop('checked' ,res.data.data.is_enable_stamp);
}

async function dataCityUpdateBranchSetting() {
    let country_id = await $('#country-update-branch-setting').val();
    let method = 'get',
        url = 'branch-setting.cities-data',
        params = {country_id: 1},
        data = '';
    let res = await axiosTemplate(method, url, params, data);

    $('#select-city-update-branch-setting').html(res.data[0]);
    await dataDistrictUpdateBranchSetting();
}

async function dataDistrictUpdateBranchSetting() {
    let city_id = await $('#select-city-update-branch-setting').val();
    let method = 'get',
        url = 'branch-setting.districts-data',
        params = {city_id: city_id},
        data = '';
    let res = await axiosTemplate(method, url, params, data,[$("#select-district-update-branch-setting")]);
    $('#select-district-update-branch-setting').html(res.data);
    await dataWardUpdateBranchSetting();
}
async function dataWardUpdateBranchSetting() {
    let district_id = await $('#select-district-update-branch-setting').val();
    let method = 'get',
        url = 'branch-setting.wards-data',
        params = {district_id: district_id},
        data = '';
    let res = await axiosTemplate(method, url, params, data,[$("#select-ward-update-branch-setting")]);
    $('#select-ward-update-branch-setting').html(res.data);
}

async function updateBranchSetting() {
    if (checkSaveUpdateBranchSetting === 1) return false;
    if (!checkValidateSave($('#branch-setting-tab-2')))
        return false;
    let is_offline = Number($('#is-offline-branch').is(':checked')),
        led_adv = Number($('#led-adv').is(':checked')),
        is_enable_booking = Number($('#is-enable-booking-branch').is(':checked')),
        is_enable_fish_bowl = Number($('#is-enable-fish-bowl').is(':checked')),
        is_enable_stamp = Number($('#is-enable-print-stamp').val());

    checkSaveUpdateBranchSetting = 1;
    let method = 'post',
        url = 'branch-setting.update-setting',
        params = '',
        data = {
            branch: branchSettingId,
            is_working_offline: is_offline,
            is_allow_advert: led_adv,
            is_enable_booking: is_enable_booking,
            is_enable_fish_bowl: is_enable_fish_bowl,
            is_enable_stamp: is_enable_stamp
        };
    let res = await axiosTemplate(method, url, params, data,[$("#branch-setting-tab-2")]);
    checkSaveUpdateBranchSetting = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            restaurantImgListSettingBranch = [];
            loadData();
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
    }
}
function checkTimeActiveBranch(){
    let flag = 1;
    if(Number($('#form-radio-check-day-of-week input[type="radio"]:checked').val()) == 0){
        $('#select-date-update-branch-setting input[type="checkbox"]').each(function(i,v) {
                if($(v).parents('.parent-node').find('.start-time-date-time-picker').val() == $(v).parents('.parent-node').find('.time-out-date-time-picker').val()){
                    WarningNotify('Thời gian hoạt động không được giống nhau');
                    $(v).parents('.parent-node').find('div.input-group').addClass('border-danger');
                    flag = 0;
                }
        })
    }else{
        if($('.start-time-date-time-picker').val() == $('.time-out-date-time-picker').val()){
            WarningNotify('Thời gian hoạt động không được giống nhau');
            $('#select-all-week-update-branch-setting div.input-group').addClass('border-danger')
            flag = 0;
            return false;
        }
    }
    return flag;
}


async function updateInfoBranchSetting() {
    if (checkSaveUpdateBranchSetting === 1) return false;
    if ($('a[data-type="2"]').hasClass('active')){
        if (!checkValidateSave($('#branch-setting-tab-2'))){
            return false;
        }
    }
    if (!checkValidateSave($('#branch-setting-tab-1'))){
        return false;
    }
    //validate giờ bắt đầu và kêts thúc không được trùng nhau
    if(!checkTimeActiveBranch()) return false;

    let country_update = $('#select-country-update-branch-setting').find('option:checked').val(),
        country_name_update = $('#select-country-update-branch-setting').find('option:checked').text(),
        city_update = $('#select-city-update-branch-setting').find('option:checked').val(),
        city_name_update = $('#select-city-update-branch-setting').find('option:checked').text(),
        district_update = $('#select-district-update-branch-setting').find('option:checked').val(),
        district_name_update = $('#select-district-update-branch-setting').find('option:checked').text(),
        ward_update = $('#select-ward-update-branch-setting').find('option:checked').val(),
        ward_name_update = $('#select-ward-update-branch-setting').find('option:checked').text(),
        name_update = $('#name-update-branch-setting').val(),
        address_note_update = $('#note-address-update-branch-setting').val(),
        phone_update = $('#phone-update-branch-setting').val(),
        avg_amount_customer_update = removeformatNumber($('#branch-avg-amount-customer-update-branch-setting').val()),
        wifi_name_update = $('#wifi-name-update-branch-setting').val(),
        wifi_password_update = $('#wifi-password-update-branch-setting').val(),
        street_name = $('#address-update-branch-setting').val(),
        wifi_update = $('#is-wifi-edit:checked').length,
        air_conditioner_update = $('#is-air-conditioner-edit:checked').length,
        parking_update = $('#is-parking-edit:checked').length,
        booking_online_update = $('#is-booking-online-edit:checked').length,
        car_parking_update = $('#is-car-parking-edit:checked').length,
        card_payment_update = $('#is-card-payment-edit:checked').length,
        child_corner_update = $('#is-child-corner-edit:checked').length,
        invoice_update = $('#is-invoice-edit:checked').length,
        karaoke_update = $('#is-karaoke-edit:checked').length,
        live_music_update = $('#is-live-music-edit:checked').length,
        order_food_online_update = $('#is-order-food-online-edit:checked').length,
        outdoor_update = $('#is-outdoor-edit:checked').length,
        private_room_update = $('#is-private-room-edit:checked').length,
        shipping_update = $('#is-shipping-edit:checked').length,
        full_address = $('#full-address-update-branch-setting').val(),
        serve_time = $('input[type=radio][name=dayOfWeek]:checked').val(),
        serve_time_arr = [],

        // setting cấu hình chung chi nhánh
        is_enable_booking = Number($('#is-enable-booking-branch').is(':checked')),
        is_take_away = Number($('#is-take-way-branch').is(':checked')),
        is_working_offline = Number($('#is-offline-branch').is(':checked')),
        is_allow_advert = Number($('#led-adv').is(':checked')),
        is_enable_fish_bowl = Number($('#is-enable-fish-bowl').is(':checked')),
        is_enable_stamp = Number($('#is-enable-print-stamp').is(':checked'));
    if (serve_time == -1) {
        serve_time_arr.push({
            "day_of_week": -1,
            "open_time": $('#select-all-week-update-branch-setting').find('.time-open-of-day').val(),
            "close_time": $('#select-all-week-update-branch-setting').find('.time-close-of-day').val(),
        })
    } else {
        $("#select-date-update-branch-setting .parent-node").each(function () {
            if ($(this).find('input[type="checkbox"]').is(':checked')) {
                serve_time_arr.push({
                    "day_of_week": $(this).find('input[type="checkbox"]').val(),
                    "open_time": $(this).find('.time-open-of-day').val(),
                    "close_time": $(this).find('.time-close-of-day').val(),
                });
            }
        });
    }
    if (serve_time_arr.length === 0) {
        WarningNotify('Không được bỏ trống thời gian hoạt động')
        return false;
    }
    checkSaveUpdateBranchSetting = 1;
    let method = 'post',
        url = 'branch-setting.update',
        params = '',
        data = {
            "id": branchSettingId,
            "name": name_update,
            "phone": phone_update,
            "lat": latSettingBranch,
            "lng": lngSettingBranch,
            "country_id": country_update,
            "country_name": country_name_update,
            "city_id": city_update,
            "city_name": city_name_update,
            "district_id": district_update,
            "district_name": district_name_update,
            "ward_id": ward_update,
            "ward_name": ward_name_update,
            "street_name": street_name,
            "address_full_text": full_address,
            "address_note": address_note_update,
            "serve_time": serve_time_arr,
            "average_amount_per_customer": avg_amount_customer_update,
            "is_have_card_payment": card_payment_update,
            "is_have_booking_online": booking_online_update,
            "is_have_order_food_online": order_food_online_update,
            "is_have_shipping": shipping_update,
            "is_free_parking": parking_update,
            "is_have_car_parking": car_parking_update,
            "is_have_air_conditioner": air_conditioner_update,
            "is_have_wifi": wifi_update,
            "wifi_name": wifi_name_update,
            "wifi_password": wifi_password_update,
            "is_have_private_room": private_room_update,
            "is_have_outdoor": outdoor_update,
            "is_have_child_corner": child_corner_update,
            "is_have_live_music": live_music_update,
            "is_have_karaoke": karaoke_update,
            "is_have_invoice": invoice_update,
            "image_logo": oldUrlLogoSettingBranch,
            "banner_image_url": oldUrlBannerSettingBranch,
            "image_urls": oldUrlImageSettingBranch,
            "is_enable_booking": is_enable_booking,
            "is_take_away" : is_take_away,
            "is_working_offline" : is_working_offline,
            "is_allow_advert" : is_allow_advert,
            "is_enable_fish_bowl" : is_enable_fish_bowl,
            "is_enable_stamp" : is_enable_stamp
        };
    let res = await axiosTemplate(method, url, params, data,[$("#branch-setting-tab-1")]);
    checkSaveUpdateBranchSetting = 0;
    let text = '';
    if(res.data[0].status !== 200){
        WarningNotify(res.data[1].message)
    }else if(res.data[1].status !== 200){
        WarningNotify(res.data[1].message)
    }else {
        text = 'Cập nhật thành công';
        SuccessNotify(text);
        $('#branch-detail-setting-name').text(res.data[1].data.name);
        thisBranchSetting.data('name', res.data[1].data.name);
        thisBranchSetting.parents('.edit-flex-auto-fill').find('.custom-name').text(res.data[1].data.name);
        $('#wifi-password-update-branch-setting').parents('.validate-group').find('.link-href').text('')
        $('#wifi-name-update-branch-setting').parents('.validate-group').find('.link-href').text('')
        $('div.input-group').removeClass('border-danger');
    }
}

async function updateBannerBranchSetting(url_banner) {
    if (checkSaveUpdateBranchSetting === 1) return false;
    let branch_ids = [];
    branch_ids.push(branchSettingId);
    checkSaveUpdateBranchSetting === 1;
    let method = 'post',
        url = 'branch-setting.update-banner',
        params = '',
        data = {
            "branch_ids": branch_ids,
            "img_link": url_banner,
        };
    let res = await axiosTemplate(method, url, params, data,[$("#thumbnail-branch-banner")]);
    checkSaveUpdateBranchSetting = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = 'Cập nhật thành công';
            SuccessNotify(text);
            $('#thumbnail-banner').attr('src', res.data.url_banner);
            thisBranchSetting.data('banner', res.data.url_banner);
            thisBranchSetting.parents('.edit-flex-auto-fill').find('.thumbnail-banner-branch').attr('src', res.data.url_banner);
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
    }
}

async function updateLogoBranchSetting(url_logo) {
    if (checkSaveUpdateBranchSetting === 1) return false;
    checkSaveUpdateBranchSetting = 1;
    let method = 'post',
        url = 'branch-setting.update-logo',
        params = '',
        data = {
            "branch_id": branchSettingId,
            "image_logo_url": url_logo,
        };
    let res = await axiosTemplate(method, url, params, data,[$("#thumbnail-branch-logo")]);
    checkSaveUpdateBranchSetting = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = 'Cập nhật thành công';
            SuccessNotify(text);
            $('#thumbnail-branch-logo').attr('src', res.data.url_logo);
            thisBranchSetting.data('logo', res.data.url_logo);
            thisBranchSetting.parents('.edit-flex-auto-fill').find('.thumbnail-branch-logo-booking').attr('src', res.data.url_logo);
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
    }
}

function activeTab(r) {
    if (r.attr('data-status') === 0){
        if (!checkValidateSave($('#branch-setting-tab-1'))) return false;
    }else if (r.attr('data-status') === 1){
        if (!checkValidateSave($('#branch-setting-tab-2'))) return false;
    }
    r.parents('ul').find('a').removeClass('active');
    r.addClass('active');
    switch (r.data('type')) {
        case 1:
            $('#branch-setting-tab-2, #branch-setting-tab-3, #branch-setting-tab-4').addClass('d-none')
            $('#branch-setting-tab-1').removeClass('d-none')
            $('#btn-update-info-branch-setting').attr('onclick', 'updateInfoBranchSetting()');
            break;
        case 2:
            $('#branch-setting-tab-1, #branch-setting-tab-3, #branch-setting-tab-4').addClass('d-none')
            $('#branch-setting-tab-2').removeClass('d-none')
            $('#btn-update-info-branch-setting').attr('onclick', 'updateBranchSetting()');
            break;
        case 4:
            $('#branch-setting-tab-2, #branch-setting-tab-3, #branch-setting-tab-1').addClass('d-none')
            $('#branch-setting-tab-4').removeClass('d-none')
            $('#div-media-setting-branch').addClass('d-none');
            $('#div-folder-setting-branch').removeClass('d-none');
            dataFolderBranch();
            break;
        default:
    }
}

function removeImage(r) {
    let title, content;
    title = 'Xoá ảnh khỏi hệ thống';
    content = "Bạn có muốn xoá ảnh và sẽ không phục hồi được"
    let icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            listImagePreview = listImageSettingBranch;
            let url = r.parents('.image-preview').find('img').data('url');
            listImagePreview = listImagePreview.filter(item => item !== url);
            updateListImageBranchSetting();
            r.parents('.image-preview').remove();
            listImageSettingBranch = listImagePreview;
        }
    })
}

function drawGallery() {
    $('.is_check_all_image').addClass('d-none');
    $('input[name="check-all-image"]').prop('checked', false);
    $('.btn-remove-all-image-branch').addClass('d-none');
    $('#btn-select-all-image').text('Chọn tất cả');
    $('#animated-thumbnails-gallery').unbind();
    jQuery("#animated-thumbnails-gallery")
        .justifiedGallery({
            captions: false,
            rowHeight: 200,
            margins: 10
        })
        .unbind('jg.complete').on("jg.complete", function () {
        window.lightGallery(
            document.getElementById("animated-thumbnails-gallery"),
            {
                selector: '.gallery-item',
                autoplayFirstVideo: false,
                pager: false,
                galleryId: "nature",
                plugins: [lgZoom, lgThumbnail],
                mobileSettings: {
                    controls: false,
                    showCloseIcon: false,
                    download: false,
                    rotate: false
                }
            }
        );
    });
}

function selectAllImage(r) {
    if (!($('input[name="check-all-image"]').is(':checked'))) {
        $('.is_check_all_image').removeClass('d-none');
        $('input[name="check-all-image"]').prop('checked', true);
        $('.btn-remove-all-image-branch').removeClass('d-none');
        r.text('Bỏ chọn');
    } else {
        $('.is_check_all_image').addClass('d-none');
        $('input[name="check-all-image"]').prop('checked', false);
        $('.btn-remove-all-image-branch').addClass('d-none');
        r.text('Chọn tất cả');
    }
}

function openModalQrcodeCheckIn() {
    $('#modal-qr-check-in-branch-manage').modal('show');
    renderQrcodeBranch(qrCodeCheckInBranchSetting);
    $('#btn-show-qr-code').removeClass('active');
}

function closeModalQrcodeCheckIn() {
    $('#modal-qr-check-in-branch-manage').modal('hide');
    $('#code-qr-check-in-branch-manage').html('');
}

function renderQrcodeBranch(data) {
    $('#code-qr-check-in-branch-manage').qrcode({
        "render": "canvas",
        "width": 200,
        "height": 200,
        "top": 2,
        "ecLevel": 'L',
        "colorDark": "#000000",
        "colorLight": "#ffffff",
        "text": data,
    });
}

async function getLatLngAddressClientCreate(text){
    let method = 'GET',
        url = 'branch-setting.search-address-map4d',
        params = {
            text : text
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$('#box-search-address-restaurant-create-client')])
    $('#box-search-address-restaurant-create-client').html(res.data[0])
}

function loadSelectListSaleCreatClient(r) {
    $('#address-update-branch-setting').val(r.find('p').text());
    $('#box-search-address-restaurant-create-client').addClass('d-none');
    $('#box-search-address-restaurant-create-client').html('');
    latSettingBranch = r.data('lat');
    lngSettingBranch = r.data('lng');
    map4D.Circle({
        center: {lat: latSettingBranch, lng: lngSettingBranch},
    });

    markerMap4D.setPosition({lat: latSettingBranch, lng: lngSettingBranch})
}



function initMap() {
    const map = new google.maps.Map(document.getElementById("map_address_branch"), {
        center: {
            lat: 10.823207404647036,
            lng: 106.70060276985168,
        },
        zoom: 13,
        mapTypeId: "roadmap",
        mapTypeControl: false,
    });
    const input = document.getElementById("address-update-branch-setting");
    const autocomplete = new google.maps.places.Autocomplete(input);
    let infowindow = new google.maps.InfoWindow();
    let marker = new google.maps.Marker({
        map: map
    });

    map.addListener("bounds_changed", () => {
        autocomplete.setBounds(map.getBounds());
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function (i, v) {
        infowindow.close();
        let place = autocomplete.getPlace();
        if(place.geometry !== undefined){
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            let image = new google.maps.MarkerImage(
                place.icon,
                new google.maps.Size(71, 71),
                new google.maps.Point(0, 0),
                new google.maps.Point(17, 34),
                new google.maps.Size(35, 35));
            marker.setIcon(image);
            marker.setPosition(place.geometry.location);


            let address = '';
            if (place.address_components) {
                address = [(place.address_components[0] && place.address_components[0].short_name || ''), (place.address_components[1] && place.address_components[1].short_name || ''), (place.address_components[2] && place.address_components[2].short_name || '')].join(' ');
            }
            updateTextFieldsUpdateBanner(place.geometry.location.lat(), place.geometry.location.lng());
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address + "<br>" + place.geometry.location);
            infowindow.open(map, marker);
        }
    });
}
