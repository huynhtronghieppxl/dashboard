let dataGiftHappyHour = 0, saveGiftHappyHour, phoneGiftHappyHour, idGiftHappyHour;

async function openModalGiftHappyHourPromotion(phone, voucher, brand, id) {
    idGiftHappyHour = id;
    saveGiftHappyHour = 0;
    phoneGiftHappyHour = phone;
    $('.popup-wraper5').addClass('active');
    await dataGiftHappyHourPromotion(brand);
    $('#list-gift-happy-hour-promotion .register-button-happy-hour').each(function (i, v) {
        if ($(this).data('value') === voucher) {
            $(this).addClass('button-focus-happy-hour');
            $(this).text('Đã chọn');
        }
    });
    $(document).on('click', '.register-button-happy-hour', function () {
        $('#list-gift-happy-hour-promotion .register-button-happy-hour').removeClass('button-focus-happy-hour');
        $('#list-gift-happy-hour-promotion .register-button-happy-hour').text('Chọn');
        $(this).addClass('button-focus-happy-hour');
        $(this).text('Đã chọn');
    });
}

async function dataGiftHappyHourPromotion(brand) {
    if (dataGiftHappyHour === 0) {
        let method = 'get',
            url = 'happy-hour-promotion.data-gift',
            params = {
                brand_id: brand
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        if (res.data[1].status === 200) {
            $('#list-gift-happy-hour-promotion').html(res.data[0]);
        } else {
            let error = (res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text();
            ErrorNotify(error);
        }
    } else {
        return true;
    }
}

async function saveGiftHappyHourPromotion() {
    if (saveGiftHappyHour === 1) return false;
    saveGiftHappyHour = 1;
    let brand_id = $('#restaurant-branch-id-selected span').attr('data-value'),
        gift = $('.button-focus-happy-hour').data('value'),
        method = 'post',
        url = 'happy-hour-promotion.gift',
        params = null,
        data = {
            brand_id: brand_id,
            gift: gift,
            phone: phoneGiftHappyHour,
            id: idGiftHappyHour,
        };
    let res = await axiosTemplate(method, url, params, data);
    saveGiftHappyHour = 0;
    if (res.data.status === 200) {
        SuccessNotify($('#success-create-data-to-server').text());
        closeModalGiftHappyHourPromotion();
        loadDataHappyHourPromotion();
    } else {
        let error = (res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text();
        ErrorNotify(error);
    }
}

function closeModalGiftHappyHourPromotion() {
    $('.popup-wraper5').removeClass('active');
}
