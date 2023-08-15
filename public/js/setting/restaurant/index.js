let idSettingRestaurant, nameSettingRestaurant, emailSettingRestaurant,phoneSettingRestaurant , addressSettingRestaurant ,domainSettingRestaurant, infoSettingRestaurant,
    checkSaveSettingRestaurant = 0, checkSaveUpdateInfoRestaurant = 0,
    tabRestaurantSetting = 0, checkSaveUpdateBannerRestaurant = 0, checkSettingSaveMemberShipCard = 0,
    checkSaveUpdateSettingRestaurant = 0, textNotification;

let pointInviteCustomer, pointToMoney, numberMinuteAllowBookingBeforeOpenOrder, latBrand;
$(function () {
    $('#is-share-customer-on-app-aloline').on('change', function () {
        if ($(this).is(':checked')) {
            $(this).attr('data-value', '1')
        }else {
            $(this).attr('data-value', '0')
        }
    })

    $('#is-enable-kai-zen-bonus-level').on('change', function () {
        if ($(this).is(':checked')) {
            $(this).attr('data-value', '1')
        }else {
            $(this).attr('data-value', '0')
        }
    })

    $('#is-quit-job-setting-restaurant').on('change', function () {
        if ($(this).is(':checked')) {
            $(this).attr('data-value', '1')
        }else {
            $(this).attr('data-value', '0')
        }
    })

    $('#is-lock-checkin-setting-restaurant').on('change', function () {
        if ($(this).is(':checked')) {
            $(this).attr('data-value', '1')
        }else {
            $(this).attr('data-value', '0')
        }
    })

    if (getCookieShared('restaurant-setting-user-id-' + idSession)) {
        let data = JSON.parse(getCookieShared('restaurant-setting-user-id-' + idSession));
        tabRestaurantSetting = data.tab;
    }
    $('#restaurant-general-configuration input:first').focus();
    $('#point_to_money').on('input', function () {
        if ($('#point_to_money').val() < 1 || $('#point_to_money').val() === '') $('#point_to_money').val('0');
    });
    $('#promotion-point-bonus').on('input', function () {
        if ($('#promotion-point-bonus').val() < 1 || $('#promotion-point-bonus').val() === '') $('#promotion-point-bonus').val('0');
    });
    $('#number_month_leave_day').on('input', function () {
        if ($('#number_month_leave_day').val() < 1 || $('#number_month_leave_day').val() === '') $('#number_month_leave_day').val('0');
    });

    $('#username-prefix').on('input', function () {
        let val = $(this).val()
        $(this).val(val.toUpperCase().replace(/\s/g, ''))
    })

    $('#restaurant-general-configuration input').on('click', function () {
        $(this).select();
    })

    $('#is_enable_membership_card').on('click', function () {
        if ($(this).is(':checked')) {
            textNotification = 'Bật thẻ thành viên thành công'
            callApiChangeStatusRestaurantMembershipCard($(this));
        }else {
            textNotification = 'Tắt thẻ thành viên thành công'
            let confirm = 'Đồng ý';
            let cancel = 'Huỷ bỏ';
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-grd-primary btn-sweet-alert swal-button--confirm',
                    cancelButton: 'btn btn-grd-disabled btn-sweet-alert swal-button--cancel'
                },
                buttonsStyling: false,
                allowEnterKey: true,
            });
            swalWithBootstrapButtons.fire({
                title: 'Bạn có muốn tắt thẻ thành viên không?',
                showCancelButton: true,
                reverseButtons: true,
                focusConfirm: true,
                confirmButtonText: confirm,
                cancelButtonText: cancel,
                icon: 'question',
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn btn-grd-primary btn-sweet-alert swal-button--confirm",
                    cancelButton: "btn btn-grd-disabled btn-sweet-alert swal-button--cancel",
                },
            }).then((result) => {
                if (result.value) {
                    changeStatusMembershipCard()
                }else {
                    $('#is_enable_membership_card').prop('checked', true)
                }
            })
        }
    })

    $('#restaurant-general-configuration .nav-link[data-type="' + tabRestaurantSetting + '"]').click();
    let element1 = $('#upload-restaurant-logo'), element2 = $('#upload-restaurant-banner'),
        view1 = $('#thumbnail-restaurant-logo'), view2 = $('#thumbnail-restaurant-banner'), type = 3; // kaizen
    uploadMediaCropTemplate(element1, view1, type, saveUpdateLogoRestaurant);
    uploadBannerCropTemplate(element2, view2, type, saveUpdateBannerRestaurant);
    dataSettingMembershipCard();

    // loadData();
    async function dataSettingMembershipCard() {
        let id = ['membership-card-use-guide-restaurant-membership-card', 'membership-card-policy-membership-card'];
        await ckEditorTemplate(id);
    }

    $('#is-quit-job-setting-restaurant').on('change', function () {
        if ($(this).is(':checked') === true) {
            $('#setting-quit-job-setting-restaurant').removeClass('d-none');
            $('#quit-job-setting-restaurant').val(1);
        } else {
            $('#setting-quit-job-setting-restaurant').addClass('d-none');
            $('#quit-job-setting-restaurant').val(0);
        }
    })
    $('#is-lock-checkin-setting-restaurant').on('change', function () {
        if ($(this).is(':checked') === true) {
            $('#setting-lock-checkin-setting-restaurant').removeClass('d-none');
            $('#number_day_not_checkin').val(1);
        } else {
            $('#setting-lock-checkin-setting-restaurant').addClass('d-none');
            $('#number_day_not_checkin').val(0);
        }
    })
    $('#number_day_not_checkin').on('focusout', function () {
        $(this).parents('.validate-group').find('.link-href').text('');
    })
    $('.percent-amount-alo-point-in-each-bill').on('input paste', function () {
        if ($(this).val() == 'NaN') {
            $(this).val(0)
        }
    })
    $(document).on('input paste', '.percent-amount-alo-point-in-each-bill,.percent-amount-setting-restaurant-membership-card', function (e) {
        $(this).val($(this).val().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, ''))
        if ($(this).val() == 'NaN') {
            $(this).val(0)
        }
    });
});

function updateCookieRestaurantSetting() {
    saveCookieShared('restaurant-setting-user-id-' + idSession, JSON.stringify({
        'tab': tabRestaurantSetting,
    }))
}

async function loadData() {
    let method = 'get',
        url = 'restaurant-setting.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$("#restaurant-general-configuration")]);
    idSettingRestaurant = res.data[0].data.id;
    nameSettingRestaurant = res.data[0].data.name;
    emailSettingRestaurant = res.data[0].data.email;
    phoneSettingRestaurant = res.data[0].data.phone;
    domainSettingRestaurant = res.data[0].data.domain;
    infoSettingRestaurant = res.data[0].data.info;
    addressSettingRestaurant = res.data[0].data.address;
    $('#name-update-restaurant-setting').val(res.data[0].data.name);

    $('#email-update-restaurant-setting').val(res.data[0].data.email);
    $('#email-update-restaurant-setting').attr('data-original-value',res.data[0].data.email);

    $('#website-update-restaurant-setting').val(res.data[0].data.domain);
    $('#website-update-restaurant-setting').attr('data-original-value',res.data[0].data.domain);

    $('#address-update-restaurant-setting').val(res.data[0].data.address);
    $('#address-update-restaurant-setting').attr('data-original-value',res.data[0].data.address);

    $('#phone-update-restaurant-setting').val(res.data[0].data.phone);
    $('#phone-update-restaurant-setting').attr('data-original-value',res.data[0].data.phone);

    $('#info-update-restaurant-setting').val(res.data[0].data.info);
    $('#info-update-restaurant-setting').attr('data-original-value',res.data[0].data.info);

    $('#restaurant-setting-name').text(res.data[0].data.name);
    $('#thumbnail-restaurant-banner').attr('src', res.data[0].banner);
    $('#thumbnail-restaurant-banner').attr('data-src', res.data[0]['data']['banner']);
    $('#thumbnail-restaurant-logo').attr('src', res.data[0].logo);
    $('#thumbnail-restaurant-logo').attr('data-src', res.data[0]['data']['logo']);

    $('#number_day_not_checkin').val(formatNumber(res.data[1].number_day_not_checkin_to_lock_account));
    $('#number_day_not_checkin').attr('data-check', res.data[1].number_day_not_checkin_to_lock_account);


    $('#quit-job-setting-restaurant').val(formatNumber(res.data[1].number_day_not_checkin_to_quit_job));
    $('#quit-job-setting-restaurant').attr('data-check', res.data[1].number_day_not_checkin_to_quit_job);

    $('#username-prefix').val(res.data[1].username_prefix);
    $('#username-prefix').attr('data-check', res.data[1].username_prefix);

    $('#point_invite_customer').val(formatNumber(res.data[1].point_bonus_for_employee_when_invite_customer_register_membership));
    $('#point_invite_customer').attr('data-check', res.data[1].point_bonus_for_employee_when_invite_customer_register_membership);

    $('#point_to_money').val(formatNumber(res.data[1].one_point_invite_customer_register_membership_to_money_amount))
    $('#point_to_money').attr('data-check', res.data[1].one_point_invite_customer_register_membership_to_money_amount);

    $('#number-minute-allow-booking-before-open-order').val(res.data[1].number_minute_allow_booking_before_open_order);
    $('#number-minute-allow-booking-before-open-order').attr('data-check', res.data[1].number_minute_allow_booking_before_open_order);

    $('#minute-after-register-member-ship-card-allow-to-use-promotion-point').val(res.data[1].minute_atfer_register_membershipcard_allow_to_use_promotion_point / 60 );
    $('#minute-after-register-member-ship-card-allow-to-use-promotion-point').attr('data-check', res.data[1].minute_atfer_register_membershipcard_allow_to_use_promotion_point / 60);

    $('#lat-brand').val(formatNumber(res.data[1].min_distance_checkin));
    $('#lat-brand').attr('data-check', res.data[1].min_distance_checkin);

    $('#number_month_leave_day').val(formatNumber(res.data[1].number_month_after_start_working_for_bonus_leave_day));
    $('#number_month_leave_day').attr('data-check', res.data[1].number_month_after_start_working_for_bonus_leave_day);




    $('#alo-point-allow-use-in-each-bill').attr('data-check', res.data[1].maximum_money_by_alo_point_allow_use_in_each_bill);
    $('#percent-amount-setting-restaurant-membership-card').attr('data-check', res.data[1].maximum_percent_order_amount_to_promotion_point_allow_use_in_each_bill);
    $('#is-share-customer-on-app-aloline').attr('data-check', res.data[1].is_share_customer_on_app_party);
    $('#is_enable_membership_card').attr('data-check', res.data[1].is_enable_membership_card);
    $('#is-enable-kai-zen-bonus-level').attr('data-check', res.data[1].is_enable_kaizen_bonus_level);
    $('#name-update-restaurant-setting').attr('data-check', res.data[0].data.name);
    $('#email-update-restaurant-setting').attr('data-check', res.data[0].data.email);
    $('#info-update-restaurant-setting').attr('data-check', res.data[0].data.info);
    $('#website-update-restaurant-setting').attr('data-check', res.data[0].data.domain);
    (res.data[1].number_day_not_checkin_to_quit_job === 0) ? $('#is-quit-job-setting-restaurant').attr('data-check', 0) : $('#is-quit-job-setting-restaurant').attr('data-check', 1);
    $('#username-prefix').val(res.data[1].username_prefix)
    $('#percent-amount-setting-restaurant-membership-card').val(res.data[1].maximum_percent_order_amount_to_promotion_point_allow_use_in_each_bill);
    $('#is_enable_membership_card').prop('checked', res.data[1].is_enable_membership_card);
    $('#minute-after-register-member-ship-card-allow-to-use-promotion-point').parents('.form-validate-input').find('.tool-tip i')
        .attr('data-original-title', `Sau ${res.data[1].minute_atfer_register_membershipcard_allow_to_use_promotion_point / 60} giờ kể từ lúc đăng ký thì thẻ thành viên mới có giá trị sử dụng`);
    $('#level-restaurant').text(res.data[2].service_restaurant_level_id);
    let level = res.data[2].service_restaurant_level_id
    if (res.data[2].service_restaurant_level_id == level) {
        $('.pit-rate-setting-branch li').each(function (index) {
            if (index < level) {
                $(this).addClass('rated')
            }
        })
    }
    if (res.data[1].is_share_customer_on_app_party == 0) {
        $('#is-share-customer-on-app-aloline').prop('checked', false)
        $('#is-share-customer-on-app-aloline').attr('data-check', '0')
        $('#is-share-customer-on-app-aloline').attr('data-value', '0')
    } else {
        $('#is-share-customer-on-app-aloline').prop('checked', true)
        $('#is-share-customer-on-app-aloline').attr('data-check', '1')
        $('#is-share-customer-on-app-aloline').attr('data-value', '1')
    }

    if (res.data[1].is_enable_kaizen_bonus_level == 0) {
        $('#is-enable-kai-zen-bonus-level').prop('checked', false)
        $('#is-enable-kai-zen-bonus-level').attr('data-check', '0')
        $('#is-enable-kai-zen-bonus-level').attr('data-value', '0')
    } else {
        $('#is-enable-kai-zen-bonus-level').prop('checked', true)
        $('#is-enable-kai-zen-bonus-level').attr('data-check', '1')
        $('#is-enable-kai-zen-bonus-level').attr('data-value', '1')
    }

    if (res.data[1].number_day_not_checkin_to_quit_job == 0) {
        $('#is-quit-job-setting-restaurant').prop('checked', false)
        $('#is-quit-job-setting-restaurant').attr('data-check', '0')
        $('#is-quit-job-setting-restaurant').attr('data-value', '0')
        $('#setting-quit-job-setting-restaurant').addClass('d-none');
    } else {
        $('#is-quit-job-setting-restaurant').prop('checked', true)
        $('#is-quit-job-setting-restaurant').attr('data-check', '1')
        $('#is-quit-job-setting-restaurant').attr('data-value', '1')
        $('#setting-quit-job-setting-restaurant').removeClass('d-none');
    }

    if (res.data[1].number_day_not_checkin_to_lock_account === 0) {
        $('#setting-lock-checkin-setting-restaurant').addClass('d-none');
        $('#is-lock-checkin-setting-restaurant').attr('data-check', '0')
        $('#is-lock-checkin-setting-restaurant').attr('data-value', '0')
        $('#is-lock-checkin-setting-restaurant').prop('checked', false);
    } else {
        $('#is-lock-checkin-setting-restaurant').prop('checked', true);
        $('#is-lock-checkin-setting-restaurant').attr('data-check', '1')
        $('#is-lock-checkin-setting-restaurant').attr('data-value', '1')
        $('#setting-lock-checkin-setting-restaurant').removeClass('d-none');
    }
}

async function saveUpdateLogoRestaurant(logo) {
    if (checkSaveSettingRestaurant === 1) return false;
    checkSaveSettingRestaurant = 1;
    let method = 'POST',
        url = 'restaurant-setting.update',
        params = null,
        data = {
            name: nameSettingRestaurant,
            email: emailSettingRestaurant,
            info: infoSettingRestaurant,
            domain: domainSettingRestaurant,
            phone: domainSettingRestaurant,
            logo: logo,
            address: addressSettingRestaurant,
            banner: $('#thumbnail-restaurant-banner').attr('data-src')
        };
    let res = await axiosTemplate(method, url, params, data, [$("#thumbnail-restaurant-logo")]);
    checkSaveSettingRestaurant = 0;
    let text = 'Cập nhật logo thành công';
    switch (res.data.status) {
        case 200:
            $('#thumbnail-restaurant-logo').attr('src', res.data.data.url_logo),
                $('#thumbnail-restaurant-logo').attr('data-src', logo),
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
    if (checkSaveUpdateBannerRestaurant === 1) return false;
    checkSaveUpdateBannerRestaurant = 1;
    let method = 'POST',
        url = 'restaurant-setting.update',
        params = null,
        data = {
            name: nameSettingRestaurant,
            email: emailSettingRestaurant,
            info: infoSettingRestaurant,
            phone: phoneSettingRestaurant,
            domain: domainSettingRestaurant,
            logo: $('#thumbnail-restaurant-logo').attr('data-src'),
            banner: banner,
            address: $('#address-update-restaurant-setting').val(),
            min_check_in: $('#lat-brand').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$("#thumbnail-restaurant-banner")]);
    checkSaveUpdateBannerRestaurant = 0;
    let text = 'Cập nhật ảnh bìa thành công';
    switch (res.data.status) {
        case 200:
            $('#thumbnail-restaurant-banner').attr('src', res.data.data.url_banner);
            $('#thumbnail-restaurant-banner').attr('data-src', banner);
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
    if (checkSaveUpdateInfoRestaurant === 1) return false;
    if (!checkValidateSave($('#restaurant-setting-tab-info'))) return false;
    // Chặn update khi không thay đổi các trường ở trang info
    // if ($('#phone-update-restaurant-setting').val() == $('#phone-update-restaurant-setting').attr('data-original-value') &&
    //     $('#email-update-restaurant-setting').val() == $('#email-update-restaurant-setting').attr('data-original-value') &&
    //     $('#website-update-restaurant-setting').val() == $('#website-update-restaurant-setting').attr('data-original-value') &&
    //     $('#address-update-restaurant-setting').val() == $('#address-update-restaurant-setting').attr('data-original-value') &&
    //     $('#info-update-restaurant-setting').val() == $('#info-update-restaurant-setting').attr('data-original-value'))
    // {
    //     SuccessNotify('Cập nhật thành công')
    //     return
    // }
    checkSaveUpdateInfoRestaurant = 1;
    let method = 'post',
        url = 'restaurant-setting.update',
        params = null,
        data = {
            name: $('#name-update-restaurant-setting').val(),
            email: $('#email-update-restaurant-setting').val(),
            info: $('#info-update-restaurant-setting').val(),
            domain: $('#website-update-restaurant-setting').val(),
            phone: $('#phone-update-restaurant-setting').val(),
            logo: $('#thumbnail-restaurant-logo').attr('data-src'),
            banner: $('#thumbnail-restaurant-banner').attr('data-src'),
            address: $('#address-update-restaurant-setting').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$("#restaurant-general-configuration")]);
    checkSaveUpdateInfoRestaurant = 0;
    let text = 'Cập nhật thành công !';
    switch (res.data.status) {
        case 200:
            nameSettingRestaurant = res.data.data.name;
            emailSettingRestaurant = res.data.data.email;
            domainSettingRestaurant = res.data.data.domain;
            infoSettingRestaurant = res.data.data.info;
            phoneSettingRestaurant = res.data.data.phone;
            SuccessNotify(text);
            shortcut.remove('F4');
            loadData();
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

function openDetailSettingBranch() {
    $('#modal-detail-branch').modal('show');
    $('.select-level-create-restaurant').find('input[value=' + $('#level-restaurant').text() + ']').prop('checked', true);
    shortcut.add('ESC', function () {
        $('#modal-detail-branch').modal('hide');
    })
}

async function saveUpdateSettingRestaurant() {

    // Chặn update khi không thay đổi các trường ở trang setting
    pointInviteCustomer = removeformatNumber($('#point_invite_customer').val());
    pointToMoney = removeformatNumber($('#point_to_money').val());
    numberMinuteAllowBookingBeforeOpenOrder = removeformatNumber($('#number-minute-allow-booking-before-open-order').val());
    latBrand = removeformatNumber($('#lat-brand').val());

    if ($('#is-quit-job-setting-restaurant').is(':checked')) {
        if ($('#is-lock-checkin-setting-restaurant').is(':checked')) {
            if ($('#username-prefix').val() == $('#username-prefix').data('check') &&
                pointInviteCustomer == $('#point_invite_customer').data('check') &&
                pointToMoney == $('#point_to_money').data('check') &&
                numberMinuteAllowBookingBeforeOpenOrder == $('#number-minute-allow-booking-before-open-order').data('check') &&
                $('#minute-after-register-member-ship-card-allow-to-use-promotion-point').val() == $('#minute-after-register-member-ship-card-allow-to-use-promotion-point').data('check') &&
                latBrand == $('#lat-brand').data('check') &&
                $('#number_month_leave_day').val() == $('#number_month_leave_day').data('check') &&
                $('#is-share-customer-on-app-aloline').attr('data-value') == $('#is-share-customer-on-app-aloline').data('check') &&
                $('#is-enable-kai-zen-bonus-level').attr('data-value') == $('#is-enable-kai-zen-bonus-level').data('check') &&
                $('#is-quit-job-setting-restaurant').attr('data-value') == $('#is-quit-job-setting-restaurant').data('check') &&
                $('#is-lock-checkin-setting-restaurant').attr('data-value') == $('#is-lock-checkin-setting-restaurant').data('check') &&
                $('#quit-job-setting-restaurant').val() == $('#quit-job-setting-restaurant').data('check') &&
                $('#number_day_not_checkin').val() == $('#number_day_not_checkin').data('check'))
            {
                SuccessNotify('Cập nhật thành công')

                // Xoá phím tắt cho nút cập nhật
                shortcut.remove('F4');
                return;
            }
        }else {
            if ($('#username-prefix').val() == $('#username-prefix').data('check') &&
                pointInviteCustomer == $('#point_invite_customer').data('check') &&
                pointToMoney == $('#point_to_money').data('check') &&
                numberMinuteAllowBookingBeforeOpenOrder == $('#number-minute-allow-booking-before-open-order').data('check') &&
                $('#minute-after-register-member-ship-card-allow-to-use-promotion-point').val() == $('#minute-after-register-member-ship-card-allow-to-use-promotion-point').data('check') &&
                latBrand == $('#lat-brand').data('check') &&
                $('#number_month_leave_day').val() == $('#number_month_leave_day').data('check') &&
                $('#is-share-customer-on-app-aloline').attr('data-value') == $('#is-share-customer-on-app-aloline').data('check') &&
                $('#is-enable-kai-zen-bonus-level').attr('data-value') == $('#is-enable-kai-zen-bonus-level').data('check') &&
                $('#is-quit-job-setting-restaurant').attr('data-value') == $('#is-quit-job-setting-restaurant').data('check') &&
                $('#is-lock-checkin-setting-restaurant').attr('data-value') == $('#is-lock-checkin-setting-restaurant').data('check') &&
                $('#quit-job-setting-restaurant').val() == $('#quit-job-setting-restaurant').data('check'))
            {
                SuccessNotify('Cập nhật thành công')

                // Xoá phím tắt cho nút cập nhật
                shortcut.remove('F4');
                return;
            }
        }
    } else if ($('#is-lock-checkin-setting-restaurant').is(':checked')) {
        if ($('#username-prefix').val() == $('#username-prefix').data('check') &&
            pointInviteCustomer == $('#point_invite_customer').data('check') &&
            pointToMoney == $('#point_to_money').data('check') &&
            numberMinuteAllowBookingBeforeOpenOrder == $('#number-minute-allow-booking-before-open-order').data('check') &&
            $('#minute-after-register-member-ship-card-allow-to-use-promotion-point').val() == $('#minute-after-register-member-ship-card-allow-to-use-promotion-point').data('check') &&
            latBrand == $('#lat-brand').data('check') &&
            $('#number_month_leave_day').val() == $('#number_month_leave_day').data('check') &&
            $('#is-share-customer-on-app-aloline').attr('data-value') == $('#is-share-customer-on-app-aloline').data('check') &&
            $('#is-enable-kai-zen-bonus-level').attr('data-value') == $('#is-enable-kai-zen-bonus-level').data('check') &&
            $('#is-quit-job-setting-restaurant').attr('data-value') == $('#is-quit-job-setting-restaurant').data('check') &&
            $('#is-lock-checkin-setting-restaurant').attr('data-value') == $('#is-lock-checkin-setting-restaurant').data('check') &&
            $('#number_day_not_checkin').val() == $('#number_day_not_checkin').attr('data-check'))
        {
            SuccessNotify('Cập nhật thành công')

            // Xoá phím tắt cho nút cập nhật
            shortcut.remove('F4');
            return false;
        }
    } else {
        if ($('#username-prefix').val() == $('#username-prefix').data('check') &&
            pointInviteCustomer == $('#point_invite_customer').data('check') &&
            pointToMoney == $('#point_to_money').data('check') &&
            numberMinuteAllowBookingBeforeOpenOrder == $('#number-minute-allow-booking-before-open-order').data('check') &&
            $('#minute-after-register-member-ship-card-allow-to-use-promotion-point').val() == $('#minute-after-register-member-ship-card-allow-to-use-promotion-point').data('check') &&
            latBrand == $('#lat-brand').data('check') &&
            $('#number_month_leave_day').val() == $('#number_month_leave_day').data('check') &&
            $('#is-share-customer-on-app-aloline').attr('data-value') == $('#is-share-customer-on-app-aloline').data('check') &&
            $('#is-enable-kai-zen-bonus-level').attr('data-value') == $('#is-enable-kai-zen-bonus-level').data('check') &&
            $('#is-quit-job-setting-restaurant').attr('data-value') == $('#is-quit-job-setting-restaurant').data('check') &&
            $('#is-lock-checkin-setting-restaurant').attr('data-value') == $('#is-lock-checkin-setting-restaurant').data('check'))
        {
            SuccessNotify('Cập nhật thành công')

            // Xoá phím tắt cho nút cập nhật
            shortcut.remove('F4');
            return;
        }
    }


    if (checkSaveUpdateSettingRestaurant === 1) return false;
    if (!checkValidateSave($('#restaurant-setting-tab-setting'))) {
        return false;
    }
    if (Number($('#number_day_not_checkin').val()) > Number($('#quit-job-setting-restaurant').val()) && $('#quit-job-setting-restaurant').val() != 0) {
        $('#number_day_not_checkin').parents('.validate-group').find('.link-href').text('Số ngày khoá tài khoản phải bé hơn hoặc bằng số ngày tự động thôi việc');
        $('#number_day_not_checkin').parents('.form-validate-input').addClass('validate-error')
        $('#number_day_not_checkin').parents('.validate-group').find('.link-href').addClass('text-danger');
        return false;
    }
    let username_prefix = $('#username-prefix').val(),
        number_minute_allow_booking_before_open_order = removeformatNumber($('#number-minute-allow-booking-before-open-order').val()),
        minute_after_register_member_ship_card_allow_to_use_promotion_point = removeformatNumber($('#minute-after-register-member-ship-card-allow-to-use-promotion-point').val()) * 60,
        number_day_not_checkin = $('#number_day_not_checkin').val(),
        number_day_quit_job = $('#quit-job-setting-restaurant').val(),
        number_month_leave_day = $('#number_month_leave_day').val(),
        point_invite_customer = $('#point_invite_customer').val(),
        is_enable_membership_card = Number($('#is_enable_membership_card').is(':checked')),
        one_point_invite_customer_register_membership_to_money_amount = $('#point_to_money').val(),
        percent_amount_setting_restaurant_membership_card = $('#percent-amount-setting-restaurant-membership-card').val(),
        percent_amount_alo_point_in_each_bill = removeformatNumber($('#percent-amount-alo-point-in-each-bill').val()),
        alo_point_allow_use_in_each_bill = $('#alo-point-allow-use-in-each-bill').val(),
        is_share_customer_on_app_party = Number($('#is-share-customer-on-app-aloline').is(':checked')),
        is_enable_kai_zen_bonus_levels = Number($('#is-enable-kai-zen-bonus-level').is(':checked')),
        min_distance_checkin = removeformatNumber($('#lat-brand').val());
    checkSaveUpdateSettingRestaurant = 1;
    let method = 'post',
        url = 'restaurant-setting.update-setting',
        params = null,
        data = {
            username_prefix: username_prefix,
            number_day_not_checkin: removeformatNumber(number_day_not_checkin),
            number_day_quit_job: removeformatNumber(number_day_quit_job),
            number_month_leave_day: removeformatNumber(number_month_leave_day),
            point_invite_customer: removeformatNumber(point_invite_customer),
            is_enable_membership_card: is_enable_membership_card,
            is_share_customer_on_app_party: is_share_customer_on_app_party,
            promotion_point_bonus: 1,
            one_point_invite_customer_register_membership_to_money_amount: removeformatNumber(one_point_invite_customer_register_membership_to_money_amount),
            percent_amount_setting_restaurant_membership_card: percent_amount_setting_restaurant_membership_card,
            percent_amount_alo_point_in_each_bill: percent_amount_alo_point_in_each_bill,
            alo_point_allow_use_in_each_bill: removeformatNumber(alo_point_allow_use_in_each_bill),
            number_minute_allow_booking_before_open_order: number_minute_allow_booking_before_open_order,
            minute_after_register_member_ship_card_allow_to_use_promotion_point: minute_after_register_member_ship_card_allow_to_use_promotion_point,
            is_enable_kai_zen_bonus_level: is_enable_kai_zen_bonus_levels,
            min_distance_checkin: min_distance_checkin
        };
    let res = await axiosTemplate(method, url, params, data, [$("#restaurant-setting-tab-setting")]);
    checkSaveUpdateSettingRestaurant = 0;
    let text = 'Chỉnh sửa thành công !';
    switch (res.data.status) {
        case 200:
            $('#is_enable_membership_card').on('change', function () {
                changeStatusMembershipCard()
            })
            SuccessNotify(text);
            // $('#number_day_not_checkin').parents('.validate-group').find('.link-href').text('');
            shortcut.remove('F4');
            loadData()
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

async function callApiChangeStatusRestaurantMembershipCard(r) {
    addLoading('restaurant-membership-card.data-setting', '#loading-modal-setting-restaurant-membership-card');
    $('#modal-setting-restaurant-membership-card').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalSettingMembershipCard(r)
    })
    $('#check-setting-restaurant-membership-card').on('change', function () {
        if ($(this).is(':checked') === true) {
            $('#btn-save-setting-restaurant-membership-card').removeClass('d-none');
            shortcut.remove('F4');
        } else {
            $('#btn-save-setting-restaurant-membership-card').addClass('d-none');
            shortcut.add('F4', function () {
                saveModalSettingMembershipCard();
            });
        }
    });
}


async function saveModalSettingMembershipCard() {
    if (!checkValidateSave($('#modal-setting-restaurant-membership-card'))) return false;
    let
        condition = CKEDITOR.instances['membership-card-use-guide-restaurant-membership-card'].getData(),
        policy = CKEDITOR.instances['membership-card-policy-membership-card'].getData();
        // checkSettingSaveMemberShipCard = 1;
    let method = 'post',
        url = 'restaurant-setting.setting-membership-card',
        params = {},
        data = {
            condition: condition,
            policy: policy,
        };
    let res = await axiosTemplate(method, url, params, data);
    let text = '';
    if (res.data.status === 200) {
        closeModalSettingMembershipCard()
        text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        changeStatusMembershipCard()
    } else {
        text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
        return false;
    }

}

async function changeStatusMembershipCard() {
    let method = 'post',
        url = 'restaurant-membership-card.change-status-restaurant',
        params = {},
        data = {
            id: idSettingRestaurant
        };
    let res = await axiosTemplate(method, url, params, data)
    if (res.data.status == 200) {
        SuccessNotify(textNotification);
    }else {
        let text = 'Lỗi rồi';
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
        return false;
    }
}

function closeModalSettingMembershipCard(r) {
    $('#modal-setting-restaurant-membership-card').modal('hide');
    $('#check-setting-restaurant-membership-card').prop('checked', false)
    $('#btn-save-setting-restaurant-membership-card').addClass('d-none');
    $('#percent-amount-setting-restaurant-membership-card').val('0');
    $('#percent-amount-alo-point-in-each-bill').val('0');
    $('#alo-point-allow-use-in-each-bill').val('0');
}


