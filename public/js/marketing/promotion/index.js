let layoutVisiblePromotion = 1;

$(function () {
    hiddenButtonActionPromotion();
});

function loadData() {
    switch (layoutVisiblePromotion) {
        case 1:
            loadDataHappyTimePromotion();
            break;
        case 2:
            loadDataVoucherPromotion();
            break;
        case 3:
            loadDataHappyHourPromotion();
            break;
        default:
            console.log(layoutVisiblePromotion);
    }
}

function openModalButtonOnePromotion() {
    switch (layoutVisiblePromotion) {
        case 1:
            openModalCreateHappyTimePromotion();
            break;
        case 2:
            openModalCreateVoucherPromotion();
            break;
        case 3:
            openModalCreateHappyHourPromotion();
            break;
        default:
            console.log(layoutVisiblePromotion);
    }
}

function openHappyTimePromotion() {
    addLoading('happy-time-promotion.data');
    addLoading('happy-time-promotion.apply');
    addLoading('happy-time-promotion.pause');
    dateTimePickerNormalTemplate($('#from-date-happy-time-promotion'));
    dateTimePickerNormalTemplate($('#to-date-happy-time-promotion'));
    $('#list-promotion-landing').addClass('d-none');
    $('#layout-happy-time-promotion').removeClass('d-none');
    $('#form-btn-back-branch').removeClass('d-none');
    $('#button-service-1').removeClass('d-none');
    $('#button-service-2').removeClass('d-none');
    layoutVisiblePromotion = 1;
    shortcut.add('F2', function () {
        openModalCreateCustomerPromotion();
    });
    $('#from-date-happy-time-promotion').val('01/' + moment().format('MM/YYYY'));
    $('#to-date-happy-time-promotion').val(moment().format('DD/MM/YYYY'));
    $('#search-btn-happy-time-promotion').on('click', function () {
        loadDataHappyTimePromotion();
    });
    $('#change_branch').on('change', function () {
        loadDataHappyTimePromotion();
    });
    loadDataHappyTimePromotion();
}

function openVoucherPromotion() {
    layoutVisiblePromotion = 2;
    $('#list-promotion-landing').addClass('d-none');
    $('#layout-voucher-promotion').removeClass('d-none');
    $('#button-service-1').removeClass('d-none');
    $('#form-btn-back-branch').removeClass('d-none');
    addLoading('voucher-promotion.data');
    dateTimePickerNormalTemplate($('#from-date-voucher-promotion'));
    dateTimePickerNormalTemplate($('#to-date-voucher-promotion'));
    $('#from-date-voucher-promotion').val('01/' + moment().format('MM/YYYY'));
    $('#to-date-voucher-promotion').val(moment().format('DD/MM/YYYY'));
    $('#search-btn-voucher-promotion').on('click', function () {
        loadDataVoucherPromotion();
    });


    loadDataVoucherPromotion();
}

function openHappyHourPromotion() {
    layoutVisiblePromotion = 3;
    $('#list-promotion-landing').addClass('d-none');
    $('#layout-happy-hour-promotion').removeClass('d-none');
    $('#form-btn-back-branch').removeClass('d-none');
    $('#button-service-1').removeClass('d-none');
    addLoading('happy-hour-promotion.data');
    addLoading('happy-hour-promotion.update');
    loadDataHappyHourPromotion();
}


function hiddenButtonActionPromotion() {
    $('#button-service-1').addClass('d-none')
    $('#button-service-2').addClass('d-none')
}

function btnBackPomotion() {
    $('#list-promotion-landing').removeClass('d-none');
    $('#form-btn-back-branch').addClass('d-none');
    $('#button-service-1').addClass('d-none');
    $('#button-service-2').addClass('d-none');
    switch (layoutVisiblePromotion) {
        case 1:
            $('#layout-happy-time-promotion').addClass('d-none');
            break;
        case 2:
            $('#layout-voucher-promotion').addClass('d-none');
            break;
        case 3:
            $('#layout-happy-hour-promotion').addClass('d-none');
            break;
        default:
            console.log(layoutVisiblePromotion);
    }
}



