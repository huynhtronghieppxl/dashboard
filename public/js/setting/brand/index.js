let brandSettingId, uploadCropAvatar, rawImg, thisBrandSetting, oldBrandSettingId, phoneBrandSetting = 0, logoBrandSetting, bannerBrandSetting,
    nameBrandSetting, descriptionBrandSetting, branchTypeBrandSetting, serviceRestaurantLevelTypeBrandSetting,
    serviceRestaurantLevelIdBrandSetting, branchTypeOptionBrandSetting, checkSaveUpdateBrandSetting = 0,checkSaveInfoBrandSetting = 0,
     checkSaveAvatarBrandSetting = 0,checkSaveBannerBrandSetting = 0, tabIndexBrandSetting = 0, tabSettingBrandSetting = 0,
    tabTypeBrandSetting = 0;
$(function () {
    if (getCookieShared('brand-setting-user-id-' + idSession)) {
        let data = JSON.parse(getCookieShared('brand-setting-user-id-' + idSession));
        tabIndexBrandSetting = data.tab;
        tabSettingBrandSetting = data.type;
        tabTypeBrandSetting = data.typeSetting;
    }
    $('#div-upload-sub-monitor-adv-marketing').unbind('click').on('click', function () {
        $('#upload-sub-monitor-adv-marketing').click();
    });
    dateTimePickerHourTemplate($('#report-time'))
    let element_logo = $('#upload-brand-logo'), element_banner = $('#upload-brand-banner'),
        view_logo = $('#thumbnail-brand-logo'), view_banner = $('#thumbnail-brand-banner'), type = 0;
    uploadMediaCropTemplate(element_logo, view_logo, type, saveUpdateLogoBrand);
    uploadBannerCropTemplate(element_banner, view_banner, type, saveUpdateBannerBrand);
    dataSettingMembershipCard();
    loadData();

    $(document).on('change', '#upload-sub-monitor-adv-marketing', async function () {
        jQuery.each($(this).prop('files'), async function (i, v) {
            if ($(v)[0].size > (10 * 1024 * 1024)) {
                WarningNotify('Ảnh ' + $(v)[0].name_file + 'có kích thước lớn hơn 10MB');
            } else {
                let data = await uploadMediaTemplate($(v)[0], 0);
                $('#picture-create-food-addition-brand-manage').attr('src', URL.createObjectURL($(this).prop('files')[i]));
                $('#data-image-sub-monitor').append(`<div class="col-xl-2 col-lg-3 col-sm-3 col-xs-12">
                                                        <a href="" data-toggle="lightbox" data-title="A random title" data-footer="A custom footer text">
                                                            <img src="..\files\assets\images\light-box\sl5.jpg" class="img-fluid m-b-10" alt="">
                                                        </a)
                                                    </div>`)

            }
        });
        $(this).replaceWith($(this).val('').clone(true));
    })

    $(document).on('click', '#group-zalo-setting .title-name-group',  function (e) {
        if($(this).parents().find('.hidden-sms-brand-setting').is(":hidden")){
            $(this).find('i').attr('class', '');
            $(this).find('i').addClass('icofont icofont-caret-up text-black-50');
        }else {
            $(this).find('i').attr('class', '');
            $(this).find('i').addClass('icofont icofont-caret-down text-black-50');
        }
        $(this).parents().find('.hidden-sms-brand-setting').slideToggle();
    });
    $(document).on('click', '#group-vihat-setting .title-name-group',  function (e) {
        if($(this).parents().find('.hidden-esms-secret-key-setting, .hidden-esms-secret-key-setting').is(":hidden")){
            $(this).find('i').attr('class', '');
            $(this).find('i').addClass('icofont icofont-caret-up text-black-50');
        }else {
            $(this).find('i').attr('class', '');
            $(this).find('i').addClass('icofont icofont-caret-down text-black-50');
        }
        $(this).parents().find('.hidden-esms-secret-key-setting, .hidden-esms-secret-key-setting').slideToggle();
    });
    $(document).on('input paste', '#percent-amount-brand-alo-point-in-each-bill',  function (e) {
        $(this).val($(this).val().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g,''))
    });
    $(document).on('input paste', '#percent-amount-setting-brand-membership-card',  function (e) {
        if($(this).val() == 'NaN'){
            $(this).val(0)
        }
    });

    $('#link-url-web').on('click',  function () {
        $(this).tooltip('hide');
        $('.tooltip.fade.bs-tooltip-top').removeClass('show');
    })
})

function updateCookie() {
    saveCookieShared('brand-setting-user-id-' + idSession, JSON.stringify({
        'tab': tabIndexBrandSetting,
        'type' : tabSettingBrandSetting,
        'typeSetting' : tabTypeBrandSetting
    }))
}

async function loadData() {
    let method = 'get',
        url = 'brand-setting.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#list-brand-setting').html(res.data[0]);
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
    if (res.data[1] > 1) {
        $('.brand-setting-detail').on('click', function () {
            $('#brand-profile-setting').removeClass('d-none');
            $('#list-brand-setting').addClass('d-none');
        })
        $('#btn-back-list-brand').on('click', function () {
            tabTypeBrandSetting = 0;
            updateCookie();
            $('#brand-profile-setting').addClass('d-none');
            $('#list-brand-setting').removeClass('d-none');
        });
    } else {
        $('#brand-profile-setting').removeClass('d-none');
        $('#list-brand-setting').addClass('d-none');
        brandSettingId = res.data[2].data[0].id;
        nameBrandSetting = res.data[2].data[0].name;
        descriptionBrandSetting = res.data[2].data[0].description;
        branchTypeBrandSetting = res.data[2].data[0].setting.branch_type;
        branchTypeOptionBrandSetting = res.data[2].data[0].setting.branch_type_option;
        serviceRestaurantLevelIdBrandSetting = res.data[2].data[0].service_restaurant_level_id;
        serviceRestaurantLevelTypeBrandSetting = res.data[2].data[0].service_restaurant_level_type;

        $('#thumbnail-brand-logo').attr('src', res.data[2].data[0].logo_url);
        $('#thumbnail-brand-banner').attr('src', res.data[2].data[0].banner_url);
        $('#thumbnail-brand-logo').attr('data-src', res.data[2].data[0].logo_url);
        $('#thumbnail-brand-banner').attr('data-src', res.data[2].data[0].banner_url);
        $('#brand-detail-setting-name').text(res.data[2].data[0].name);
        $('#name-update-brand-setting').val(res.data[2].data[0].name);
        $('#phone-update-brand-setting').val(res.data[2].data[0].phone);
        $('#description-update-brand-setting').val(res.data[2].data[0].description);
        dataSettingBrand(res.data[2].data[0].id);
        $('#price-detail-paradigm-restaurant').text(res.data[2].data[0].service_restaurant_level_price);

        switch (serviceRestaurantLevelTypeBrandSetting) {
            case 1 :
                $('#scale-detail-paradigm-restaurant').text("Mô hình 1 (Bill chủ yếu 1 sản phẩm)");
                $('#image-scale-size-paradigm-brand-restaurant').attr('src', 'https://beta.storage.aloapp.vn/public/resource/TMS/FOOD/0/0/1/2022/6/8-6-2022/image/original/web-1654692947-medium.jpg');
                break;
            case 2 :
                $('#scale-detail-paradigm-restaurant').text("Mô hình 2 (Bill chủ yếu 2,3 sản phẩm)");
                $('#image-scale-size-paradigm-brand-restaurant').attr('src', 'https://beta.storage.aloapp.vn/public/resource/TMS/FOOD/0/0/1/2022/6/8-6-2022/image/original/web-1654693301-big.jpg');
                break;
            case 3 :
                $('#scale-detail-paradigm-restaurant').text("Mô hình 3 (Bill nhiều sản phẩm hơn)");
                $('#image-scale-size-paradigm-brand-restaurant').attr('src', 'https://beta.storage.aloapp.vn/public/resource/TMS/FOOD/0/0/1/2022/6/8-6-2022/image/original/web-1654693301-big.jpg');
                break;
            default:
                $('#image-scale-size-paradigm-brand-restaurant').attr('src', '');
                break;
        }

        switch (String(branchTypeBrandSetting) + String(branchTypeOptionBrandSetting)) {
            case '11':
                $('#process-detail-paradigm-restaurant').text("1");
                $('#option-detail-paradigm-restaurant').text("1");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416260131039.png');
                break;
            case '12':
                $('#process-detail-paradigm-restaurant').text("1");
                $('#option-detail-paradigm-restaurant').text("2");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416275723443.png');
                break;
            case '21':
                $('#process-detail-paradigm-restaurant').text("2");
                $('#option-detail-paradigm-restaurant').text("1");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416294059778.png');
                break;
            case '22':
                $('#process-detail-paradigm-restaurant').text("2");
                $('#option-detail-paradigm-restaurant').text("2");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647442054732288.png');
                break;
            case '23':
                $('#process-detail-paradigm-restaurant').text("2");
                $('#option-detail-paradigm-restaurant').text("3");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416328244304.png');
                break;
            case '31':
                $('#process-detail-paradigm-restaurant').text("3");
                $('#option-detail-paradigm-restaurant').text("1");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416346996843.png');
                break
            default :
                $('#process-detail-paradigm-restaurant').text(" ");
                $('#option-detail-paradigm-restaurant').text(" ");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', '');
        }
        $('#list-brand-setting').addClass('d-none');
        $('#brand-profile-setting').removeClass('d-none');
        $('#btn-back-list-brand').addClass('d-none');
    }
    $('#brand-profile-setting input').on('click', function () {
        $(this).select();
    })

    if (tabTypeBrandSetting === 1){
        $('#list-brand-setting li .brand-setting-detail[data-type="' + tabIndexBrandSetting + '"]').click();
        $('#brand-profile-setting .nav-link[data-status="' + tabSettingBrandSetting + '"]').click();
    }
    $('#brand-profile-setting .nav-link').on('click',function (){
        tabSettingBrandSetting = $(this).attr('data-status');
        updateCookie();
    })
    $('.hidden-sms-brand-setting').css('display', 'none');
    $('.hidden-esms-secret-key-setting, .hidden-esms-secret-key-setting').css('display', 'none');

}

async function dataProfileBrand(r) {
    tabTypeBrandSetting = 1;
    updateCookie();
    $('#btn-back-list-brand').removeClass('active');
    if (oldBrandSettingId !== r.data('id')) {
        thisBrandSetting = r;
        brandSettingId = r.data('id');
        nameBrandSetting = r.data('name');
        descriptionBrandSetting = r.data('description');
        phoneBrandSetting = r.data('phone');
        logoBrandSetting = r.data('logo-src');
        bannerBrandSetting = r.data('banner-src');
        branchTypeBrandSetting = r.data('branch-type'); // qui trinh
        branchTypeOptionBrandSetting = r.data('branch-type-option');
        serviceRestaurantLevelIdBrandSetting = r.data('service-restaurant-level-id')
        serviceRestaurantLevelTypeBrandSetting = r.data('service-restaurant-level-type');
        $('.select-level-create-restaurant').find('input[value=' + serviceRestaurantLevelIdBrandSetting + ']').prop('checked', true).trigger('change');
        $('.select-level-create-restaurant').find('input[value=' + serviceRestaurantLevelTypeBrandSetting + ']').prop('checked', true).trigger('change');
        $('.select-procedure-create-restaurant').find('input[value=' + branchTypeBrandSetting + ']').prop('checked', true).trigger('change');
        $('.select-option-create-restaurant').find('input[value=' + branchTypeOptionBrandSetting + ']').prop('checked', true).trigger('change');
        $('.profile-controls li a').eq(1).click();
        $('#thumbnail-brand-logo').attr('src', r.data('logo'));
        $('#thumbnail-brand-banner').attr('src', r.data('banner'));
        $('#thumbnail-brand-logo').attr('data-src', r.data('logo-src'));
        $('#thumbnail-brand-banner').attr('data-src', r.data('banner-src'));
        $('#brand-detail-setting-name').text(r.data('name'));
        $('#name-update-brand-setting').val(r.data('name'));
        $('#website-update-brand-setting').val(r.data('website'));
        $('#facebook-update-brand-setting').val(r.data('facebook-page'));
        $('#description-update-brand-setting').val(r.data('description'));
        $('#phone-update-brand-setting').val(r.data('phone'));
        $('#link-url-web').prop('href', r.data('website'));
        $('#link-url-facebook').prop('href', r.data('facebook-page'));

        $('#identifier-name-paradigm-restaurant').text(r.data('name'));
        $('#level-detail-paradigm-restaurant').text(r.data('service-restaurant-level-id'));
        $('#option-detail-paradigm-restaurant').text(r.data('branch-type-option'));
        $('#price-detail-paradigm-restaurant').text(formatNumber(r.data('service-restaurant-level-price')));
        $('#price-detail-brand').text(r.data('service-restaurant-level-price'));
        if (serviceRestaurantLevelIdBrandSetting == 2 && branchTypeOptionBrandSetting == 1) {
            $('#bill-pos-brand').parents('.form-group').removeClass('d-none');
        } else if (serviceRestaurantLevelIdBrandSetting == 1 && branchTypeOptionBrandSetting == 2) {
            $('#bill-pos-brand').parents('.form-group').removeClass('d-none');
        } else if (serviceRestaurantLevelIdBrandSetting == 1 && branchTypeOptionBrandSetting == 1) {
            $('#bill-pos-brand').parents('.form-group').removeClass('d-none');
        }
        dataSettingBrand(r.data('id'));
        tabIndexBrandSetting = r.attr('data-type');
        updateCookie();
        switch (serviceRestaurantLevelTypeBrandSetting) {
            case 1 :
                $('#scale-detail-paradigm-restaurant').text("Mô hình 1 (Bill chủ yếu 1 sản phẩm)");
                $('#image-scale-size-paradigm-brand-restaurant').attr('src', 'https://beta.storage.aloapp.vn/public/resource/TMS/FOOD/0/0/1/2022/6/8-6-2022/image/original/web-1654692947-medium.jpg');
                break;
            case 2 :
                $('#scale-detail-paradigm-restaurant').text("Mô hình 2 (Bill chủ yếu 2,3 sản phẩm)");
                $('#image-scale-size-paradigm-brand-restaurant').attr('src', 'https://beta.storage.aloapp.vn/public/resource/TMS/FOOD/0/0/1/2022/6/8-6-2022/image/original/web-1654693301-big.jpg');
                break;
            case 3 :
                $('#scale-detail-paradigm-restaurant').text("Mô hình 3 (Bill nhiều sản phẩm hơn)");
                $('#image-scale-size-paradigm-brand-restaurant').attr('src', 'https://beta.storage.aloapp.vn/public/resource/TMS/FOOD/0/0/1/2022/6/8-6-2022/image/original/web-1654693301-big.jpg');
                break;
            default:
                $('#image-scale-size-paradigm-brand-restaurant').attr('src', '');
                break;
        }
        switch (String(branchTypeBrandSetting) + String(branchTypeOptionBrandSetting)) {
            case '11':
                $('#process-detail-paradigm-restaurant').text("1");
                $('#option-detail-paradigm-restaurant').text("1");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416260131039.png');
                break;
            case '12':
                $('#process-detail-paradigm-restaurant').text("1");
                $('#option-detail-paradigm-restaurant').text("2");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416275723443.png');
                break;
            case '13':
                $('#process-detail-paradigm-restaurant').text("1");
                $('#option-detail-paradigm-restaurant').text("3");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416294059778.png');
                break;
            case '21':
                $('#process-detail-paradigm-restaurant').text("2");
                $('#option-detail-paradigm-restaurant').text("1");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416294059778.png');
                break;
            case '22':
                $('#process-detail-paradigm-restaurant').text("2");
                $('#option-detail-paradigm-restaurant').text("2");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647442054732288.png');
                break;
            case '23':
                $('#process-detail-paradigm-restaurant').text("2");
                $('#option-detail-paradigm-restaurant').text("3");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416328244304.png');
                break;
            case '31':
                $('#process-detail-paradigm-restaurant').text("3");
                $('#option-detail-paradigm-restaurant').text("1");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416346996843.png');
                break
            default :
                $('#process-detail-paradigm-restaurant').text(" ");
                $('#option-detail-paradigm-restaurant').text(" ");
                $('#image-option-size-paradigm-brand-restaurant').attr('src', '');
        }
    }
}

async function dataSettingBrand(id) {
    let method = 'get',
        url = 'brand-setting.data-setting',
        params = {restaurant_brand_id: id},
        data = '';
    let res = await axiosTemplate(method, url, params, data, [$("#brand-setting-tab1")]);
    if (res.data.data.is_enable_membership_card == 1) {
        $('#is_enable_member_ship_card').prop('checked', true);
    }else {
        $('#is_enable_member_ship_card').prop('checked', false);
    }
    oldBrandSettingId = res.data.data.id;
    $('.select-option-create-brand-restaurant input[type=radio][name=radio-option-brand]').prop('checked', true);
    $('#report-time').val(res.data.data.hour_to_take_report);
    $('#VAT').val(res.data.data.vat);
    $('#food').prop('checked', res.data.data.is_hide_category_type_food);
    $('#drink').prop('checked', res.data.data.is_hide_category_type_drink);
    $('#sea_food').prop('checked', res.data.data.is_hide_category_type_sea_food);
    $('#other').prop('checked', res.data.data.is_hide_category_type_other);

    $('#late-time-brand').val(formatNumber(res.data.data.late_minute_allow_in_month));
    $('#punish-late-brand').val(formatNumber(res.data.data.punish_working_day_in_minute));
    $('#monthly-off-brand').val(res.data.data.total_monthly_off_day);
    $('#punish-checkout-brand').val(formatNumber(res.data.data.punish_not_checkout));
    $('#yearly-off-brand').val(res.data.data.total_yearly_off_day);
    $('#advance-salary-brand').val(res.data.data.maximum_advance_salary_percent);
    // $('#bonus-brand').val(formatNumber(res.data.data.bonus_working_day));
    $('#temporary-bill-brand').prop('checked', res.data.data.is_allow_print_temporary_bill);
    $('#hidden-amount-brand').prop('checked', res.data.data.is_hide_total_amount_before_complete_bill);
    $('#customer-slot-brand').prop('checked', res.data.data.is_require_update_customer_slot_in_order);
    $('#logo-bill-brand').prop('checked', res.data.data.is_print_bill_logo);
    $('#bill-pos-brand').prop('checked', res.data.data.is_print_bill_on_mobile_app);
    $('#kichen-bill-mobile-brand').prop('checked', res.data.data.is_print_kichen_bill_on_mobile_app);
    $('#paid_user').prop('checked', res.data.data.is_paid_user);
    $('#use-bar-code').prop('checked', res.data.data.is_use_bar_code);
    $('#enable-booking').prop('checked', res.data.data.is_enable_booking);
    $('#sub-monitor-acknowledgements').val(res.data.data.sub_monitor_acknowledgements);

    $('#percent-amount-setting-brand-membership-card').val(formatNumber(res.data.data.maximum_percent_order_amount_to_promotion_point_allow_use_in_each_bill));
    $('#promotion-point-brand-allow-use-in-each-bill').val(formatNumber(res.data.data.maximum_promotion_point_allow_use_in_each_bill));


    $('#percent-amount-brand-alo-point-in-each-bill').val(formatNumber(res.data.data.maximum_percent_order_amount_to_alo_point_allow_use_in_each_bill));
    $('#alo-point-brand-allow-use-in-each-bill').val(formatNumber(res.data.data.maximum_money_by_alo_point_allow_use_in_each_bill));

    $('#percent-amount-accumulate-point-brand-allow-use-in-each-bill').val(formatNumber(res.data.data.maximum_percent_order_amount_to_accumulate_point_allow_use_in_each_bill));
    $('#accumulate-point-brand-allow-use-in-each-bill').val(formatNumber(res.data.data.maximum_accumulate_point_allow_use_in_each_bill));
    // $('#maximum_accumulate_point_allow_use_in_each_bill').val(formatNumber(Number(res.data.data.amount_bonus_booking_order_for_employee)));
    $('#zalo-oaid-setting-brand').val(res.data.data.zalo_oaid);
}

async function dataSettingMembershipCard() {
    let id = ['condition-setting-restaurant-membership-card', 'point-setting-restaurant-membership-card', 'benefit-setting-restaurant-membership-card', 'level-setting-restaurant-membership-card'];
}

async function saveUpdateSettingBrand() {
    if (checkSaveUpdateBrandSetting === 1) return false;
    if (!checkValidateSave($('#brand-setting-tab2'))) return false;
    let vat = $('#VAT').val(),
        hour_to_take_report = $('#report-time').val(),
        late_minute_allow_in_month = $('#late-time-brand').val(),
        total_monthly_off_day = $('#monthly-off-brand').val(),
        total_yearly_off_day = $('#yearly-off-brand').val(),
        // bonus_working_day = $('#bonus-brand').val(),
        punish_working_day_in_minute = $('#punish-late-brand').val(),
        punish_not_checkout = $('#punish-checkout-brand').val(),
        is_allow_print_temporary_bill = Number($('#temporary-bill-brand').is(':checked')),
        is_hide_total_amount_before_complete_bill = Number($('#hidden-amount-brand').is(':checked')),
        is_require_update_customer_slot_in_order = Number($('#customer-slot-brand').is(':checked')),
        is_print_bill_logo = Number($('#logo-bill-brand').is(':checked')),
        is_enable_membership_card = Number($('#is_enable_member_ship_card').is(':checked')),
        is_enable_booking = Number($('#enable-booking').is(':checked')),
        maximum_advance_salary_percent = removeformatNumber($('#advance-salary-brand').val()),
        maximum_promotion_point_allow_use_in_each_bill = removeformatNumber($('#promotion-point-brand-allow-use-in-each-bill').val()),
        percent_amount_to_accumulate_allow_use_in_each_bill = removeformatNumber($('#percent-amount-accumulate-point-brand-allow-use-in-each-bill').val()),
        maximum_accumulate_point_allow_use_in_each_bill = removeformatNumber($('#accumulate-point-brand-allow-use-in-each-bill').val()),
        percent_amount_to_promotion_membership_card = removeformatNumber($('#percent-amount-setting-brand-membership-card').val()),
        percent_amount_brand_alo_point = removeformatNumber($('#percent-amount-brand-alo-point-in-each-bill').val()),
        alo_point_brand = removeformatNumber($('#alo-point-brand-allow-use-in-each-bill').val()),
        zalo_oaid = $('#zalo-oaid-setting-brand').val(),
        sub_monitor_acknowledgements = $('#sub-monitor-acknowledgements').val();
    checkSaveUpdateBrandSetting = 1;
    let method = 'post',
        url = 'brand-setting.update',
        params = null,
        data = {
            restaurant_brand_id: brandSettingId,
            late_minute_allow_in_month: removeformatNumber(late_minute_allow_in_month),
            total_monthly_off_day: removeformatNumber(total_monthly_off_day),
            total_yearly_off_day: removeformatNumber(total_yearly_off_day),
            punish_working_day_in_minute: removeformatNumber(punish_working_day_in_minute),
            punish_not_checkout: removeformatNumber(punish_not_checkout),
            maximum_advance_salary_percent: removeformatNumber(maximum_advance_salary_percent),
            is_require_update_customer_slot_in_order: is_require_update_customer_slot_in_order,
            hour_to_take_report: removeformatNumber(hour_to_take_report),
            is_allow_print_temporary_bill: is_allow_print_temporary_bill,
            is_hide_total_amount_before_complete_bill: is_hide_total_amount_before_complete_bill,
            is_print_bill_logo: is_print_bill_logo,
            is_enable_membership_card: is_enable_membership_card,
            is_enable_booking: is_enable_booking,
            maximum_promotion_point_allow_use_in_each_bill: maximum_promotion_point_allow_use_in_each_bill,
            percent_amount_to_accumulate_allow_use_in_each_bill: percent_amount_to_accumulate_allow_use_in_each_bill,
            maximum_accumulate_point_allow_use_in_each_bill: maximum_accumulate_point_allow_use_in_each_bill,
            percent_amount_to_promotion_membership_card: percent_amount_to_promotion_membership_card,
            percent_amount_brand_alo_point: percent_amount_brand_alo_point,
            alo_point_brand: alo_point_brand,
            zalo_oaid: zalo_oaid,
            sub_monitor_acknowledgements : sub_monitor_acknowledgements
        };
    let res = await axiosTemplate(method, url, params, data, [$("#brand-setting-tab2")]);
    checkSaveUpdateBrandSetting = 0
    let text = 'Cập nhật thành công';
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            ErrorNotify(text);
            break;
        default:
            if (res.data.message !== null) text = res.data.message;
            WarningNotify(text);
    }
}

async function saveUpdateInfoBrand() {
    if (checkSaveInfoBrandSetting === 1) return false;
    if (!checkValidateSave($('#validate-brand')))
        return false;
    checkSaveInfoBrandSetting = 1;
    let method = 'post',
        url = 'brand-setting.update-logo',
        params = null,
        data = {
            id: brandSettingId,
            name: $('#name-update-brand-setting').val(),
            phone: $('#phone-update-brand-setting').val(),
            des: $('#description-update-brand-setting').val(),
            logo_url: $('#thumbnail-brand-logo').data('src'),
            banner: $('#thumbnail-brand-banner').data('src'),
            website: $('#website-update-brand-setting').val(),
            facebook_page: $('#facebook-update-brand-setting').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$("#brand-setting-tab1")]);
    checkSaveInfoBrandSetting = 0;
    let text = 'Cập nhật thành công';
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            $('#brand-detail-setting-name').text(res.data.data.name);
            $('#link-url-web').prop('href', res.data.data.website);
            $('#link-url-facebook').prop('href', res.data.data.facebook_page);
            nameBrandSetting = res.data.data.name;
            descriptionBrandSetting = res.data.data.description;
            // thisBrandSetting.data('name', res.data.data.name);
            // thisBrandSetting.data('description', res.data.data.description);
            // thisBrandSetting.parents('.edit-flex-auto-fill').find('.custom-name').text(res.data.data.name);
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            ErrorNotify(text);
            break;
        default:
            if (res.data.message !== null) text = res.data.message;
            WarningNotify(text);
    }
}

async function saveUpdateLogoBrand(logo) {
    if (checkSaveAvatarBrandSetting === 1) return false;
    checkSaveAvatarBrandSetting = 1;
    let method = 'post',
        url = 'brand-setting.update-logo',
        params = null,
        data = {
            id: brandSettingId,
            name: nameBrandSetting,
            phone: phoneBrandSetting,
            logo_url: logo,
            banner: bannerBrandSetting,
            des: descriptionBrandSetting,
            website: $('#website-update-brand-setting').val(),
            facebook_page: $('#facebook-update-brand-setting').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$("#thumbnail-brand-logo")]);
    checkSaveAvatarBrandSetting = 0;
    let text = 'Cập nhật thành công';
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            $('#thumbnail-brand-logo').attr('src', res.data.data.logo_url);
            // thisBrandSetting.data('logo', res.data.data.logo_url);
            // thisBrandSetting.parents('.edit-flex-auto-fill').find('.thumbnail-branch-logo-booking').attr('src', res.data.data.name);
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

async function saveUpdateBannerBrand(banner) {
    if (checkSaveBannerBrandSetting === 1) return false;
    checkSaveBannerBrandSetting = 1;
    let method = 'POST',
        url = 'brand-setting.update-banner',
        params = null,
        data = {
            restaurant_id: brandSettingId,
            name: nameBrandSetting,
            phone: phoneBrandSetting,
            logo_url: logoBrandSetting,
            banner: banner,
            des: descriptionBrandSetting,
        };
    let res = await axiosTemplate(method, url, params, data, [$("#thumbnail-brand-banner")]);
    checkSaveBannerBrandSetting = 0;
    let text = 'Cập nhật thành công';
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            $('#thumbnail-brand-banner').attr('src', res.data.data.banner);
            // // $('#thumbnail-brand-banner').attr('data', res.data)
            // thisBrandSetting.data('banner', res.data.data.banner);
            // thisBrandSetting.parents('.edit-flex-auto-fill').find('.thumbnail-banner').attr('src', res.data?.data?.banner);
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
    r.parents('ul').find('a').removeClass('active');
    r.addClass('active');
    $('[data-toggle="tooltip"]').tooltip('hide')
    switch (r.data('type')) {
        case 1:
            $('#btn-save-update-brand-setting').attr('onclick', 'saveUpdateSettingBrand()');
            break;
        default:
            $('#btn-save-update-brand-setting').attr('onclick', 'saveUpdateInfoBrand()');
            break;
    }
}

function openDetail() {
    $('#modal-detail').modal('show');
    $('.select-level-create-restaurant').find('input[value=' + serviceRestaurantLevelIdBrandSetting + ']').prop('checked', true);
    $('.select-option-size-create-restaurant').find('input[value=' + serviceRestaurantLevelTypeBrandSetting + ']').prop('checked', true);
    $('#price-detail-brand').text(formatNumber($('#price-detail-paradigm-restaurant').text()) + 'VNĐ')

    $('.select-option-size-create-restaurant input').on('change', function () {
        dataImgOptionCreate();
    })
    shortcut.add("ESC", function () {
        closeDetail();
    });
}

function dataImgOptionCreate() {
    let optionSizeCreateRestaurant = $('.select-option-size-create-restaurant input:checked').val();
    switch (optionSizeCreateRestaurant) {
        case '1' :
            $('#get-image-option-create-restaurant').attr('src', 'https://beta.storage.aloapp.vn/public/resource/TMS/FOOD/0/0/1/2022/6/8-6-2022/image/original/web-1654693836-small.jpg');
            break
        case '2' :
            $('#get-image-option-create-restaurant').attr('src', 'https://beta.storage.aloapp.vn/public/resource/TMS/FOOD/0/0/1/2022/6/8-6-2022/image/original/web-1654692947-medium.jpg');
            break
        case '3' :
            $('#get-image-option-create-restaurant').attr('src', 'https://beta.storage.aloapp.vn/public/resource/TMS/FOOD/0/0/1/2022/6/8-6-2022/image/original/web-1654693301-big.jpg');
            break
    }
}

function closeDetail() {
    shortcut.remove("ESC");
    $('#modal-detail').modal('hide');
}

function openDetailProcedure() {
    $('#detail-procedure').modal('show');
    $('.select-procedure-create-restaurant  input').on('change', async function () {
        switch ($(this).val()) {
            case '1':
                $('.select-option-create-restaurant .radio-inline:eq(1)').removeClass('d-none');
                $('.select-option-create-restaurant .radio-inline:eq(2)').removeClass('d-none');
                $('.select-option-create-restaurant .radio-inline:eq(0) input').prop('checked', true);
                break;
            case '2':
                $('.select-option-create-restaurant .radio-inline:eq(1)').removeClass('d-none');
                $('.select-option-create-restaurant .radio-inline:eq(2)').removeClass('d-none');
                $('.select-option-create-restaurant .radio-inline:eq(0) input').prop('checked', true);
                break;
            case '3':
                $('.select-option-create-restaurant .radio-inline:eq(1)').addClass('d-none');
                $('.select-option-create-restaurant .radio-inline:eq(2)').addClass('d-none');
                $('.select-option-create-restaurant .radio-inline:eq(0) input').prop('checked', true);
                break;
        }
    });
    $('.select-procedure-create-restaurant').find('input[value=' + branchTypeBrandSetting + ']').prop('checked', true).trigger('change');
    $('.select-option-create-restaurant').find('input[value=' + branchTypeOptionBrandSetting + ']').prop('checked', true).trigger('change');
    $('.select-procedure-create-restaurant input, .select-option-create-restaurant input').on('change', function () {
        dataImgDetailProcedure();
    })

    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalHistory();
    });
}

function dataImgDetailProcedure() {
    let optionImgDetailProcedure = $('.select-procedure-create-restaurant input:checked').val();
    let optionImgDetailProcedureOption = $('.select-option-create-restaurant input:checked').val();
    switch (String(optionImgDetailProcedure) + String(optionImgDetailProcedureOption)) {
        case '11':
            $('#get-image-detail-procedure').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416260131039.png');
            break;
        case '12':
            $('#get-image-detail-procedure').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416275723443.png');
            break;
        case '13':
            $('#get-image-detail-procedure').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416294059778.png');
            break;
        case '21':
            $('#get-image-detail-procedure').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416294059778.png');
            break;
        case '22':
            $('#get-image-detail-procedure').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647442054732288.png');
            break;
        case '23':
            $('#get-image-detail-procedure').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416328244304.png');
            break;
        case '31':
            $('#get-image-detail-procedure').attr('src', 'https://storage.aloapp.vn/public/resource/TMS/MEDIA_TECHRES/0/0/1/2022/3/16-3-2022/image/original/1647416346996843.png');
            break
    }
}

function closeDetailProcedure() {
    $('#detail-procedure').modal('hide');
}

